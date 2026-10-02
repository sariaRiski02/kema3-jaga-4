#!/bin/bash
# Deploy script untuk EC2
# Dijalankan oleh GitHub Actions via SSH

set -e

# Color output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}==================================================${NC}"
echo -e "${BLUE}   🚀 Deployment Script - kema3-jaga-4${NC}"
echo -e "${BLUE}==================================================${NC}"
echo ""

REGISTRY=${1:-${ECR_REGISTRY}}
REPOSITORY=${2:-${ECR_REPOSITORY}}
TAG=${3:-latest}
DEPLOY_PATH=${4:-${DEPLOY_PATH}}
AWS_REGION=${5:-${AWS_REGION}}

echo -e "${YELLOW}Configuration:${NC}"
echo "  Registry: $REGISTRY"
echo "  Repository: $REPOSITORY"
echo "  Tag: $TAG"
echo "  Deploy Path: $DEPLOY_PATH"
echo "  AWS Region: $AWS_REGION"
echo ""

# Validate inputs
if [ -z "$REGISTRY" ] || [ -z "$REPOSITORY" ] || [ -z "$DEPLOY_PATH" ]; then
    echo -e "${RED}❌ Missing required parameters!${NC}"
    echo "Usage: $0 REGISTRY REPOSITORY [TAG] [DEPLOY_PATH] [AWS_REGION]"
    exit 1
fi

IMAGE="$REGISTRY/$REPOSITORY:$TAG"
echo -e "${YELLOW}📦 Image: $IMAGE${NC}"
echo ""

# Navigate to app directory
if [ ! -d "$DEPLOY_PATH" ]; then
    echo -e "${RED}❌ Deploy path does not exist: $DEPLOY_PATH${NC}"
    exit 1
fi

cd "$DEPLOY_PATH"
echo -e "${GREEN}✓ Changed directory to: $(pwd)${NC}"
echo ""

# Step 1: Login to ECR
echo -e "${YELLOW}🔐 Step 1/7: Authenticating to ECR...${NC}"
if [ -z "$AWS_REGION" ]; then
    AWS_REGION="ap-southeast-3"
fi

aws ecr get-login-password --region $AWS_REGION | \
    docker login --username AWS --password-stdin $REGISTRY

echo -e "${GREEN}✓ ECR authentication successful${NC}"
echo ""

# Step 2: Pull latest image
echo -e "${YELLOW}📥 Step 2/7: Pulling Docker image...${NC}"
if docker pull "$IMAGE" 2>/dev/null; then
    echo -e "${GREEN}✓ Docker image pulled successfully${NC}"
else
    echo -e "${RED}❌ Failed to pull Docker image${NC}"
    exit 1
fi
echo ""

# Step 3: Stop old containers
echo -e "${YELLOW}⛔ Step 3/7: Stopping old containers...${NC}"
if docker compose -f compose.prod.yml down 2>/dev/null; then
    echo -e "${GREEN}✓ Old containers stopped${NC}"
else
    echo -e "${YELLOW}⚠️  No containers to stop (first deployment)${NC}"
fi
echo ""

# Step 4: Check/Create .env file
echo -e "${YELLOW}⚙️  Step 4/7: Verifying environment configuration...${NC}"
if [ ! -f .env ]; then
    echo -e "${YELLOW}⚠️  .env file not found! Creating from .env.example...${NC}"
    if [ -f .env.example ]; then
        cp .env.example .env
        echo -e "${YELLOW}📝 IMPORTANT: Edit .env file with correct credentials!${NC}"
        echo -e "${YELLOW}   Run: nano $DEPLOY_PATH/.env${NC}"
        echo -e "${YELLOW}   Or: vi $DEPLOY_PATH/.env${NC}"
        echo ""
        echo "   Required settings:"
        echo "   - DB_HOST (database host or container name)"
        echo "   - DB_DATABASE"
        echo "   - DB_USERNAME"
        echo "   - DB_PASSWORD"
        echo "   - APP_KEY (generate with: php artisan key:generate)"
        echo ""
    else
        echo -e "${RED}❌ .env.example not found!${NC}"
        exit 1
    fi
else
    echo -e "${GREEN}✓ .env file exists${NC}"
fi
echo ""

# Step 5: Start containers
echo -e "${YELLOW}🚀 Step 5/7: Starting containers...${NC}"
export IMAGE="$IMAGE"
if docker compose -f compose.prod.yml up -d; then
    echo -e "${GREEN}✓ Containers started${NC}"
else
    echo -e "${RED}❌ Failed to start containers${NC}"
    docker compose -f compose.prod.yml logs
    exit 1
fi
echo ""

# Wait for app to be ready
echo -e "${YELLOW}⏳ Step 6/7: Waiting for application to be ready...${NC}"
sleep 5
RETRY_COUNT=0
MAX_RETRIES=12
while [ $RETRY_COUNT -lt $MAX_RETRIES ]; do
    if docker compose -f compose.prod.yml exec -T app php artisan tinker --execute="exit;" 2>/dev/null; then
        echo -e "${GREEN}✓ Application is ready${NC}"
        break
    fi
    RETRY_COUNT=$((RETRY_COUNT + 1))
    echo "  Waiting... ($RETRY_COUNT/$MAX_RETRIES)"
    sleep 5
done

if [ $RETRY_COUNT -eq $MAX_RETRIES ]; then
    echo -e "${YELLOW}⚠️  Application readiness check timed out (continuing anyway)${NC}"
fi
echo ""

# Step 6: Run migrations and cache clearing
echo -e "${YELLOW}🔄 Step 6/7: Running migrations and clearing cache...${NC}"

# Run migrations
echo "  - Running migrations..."
docker compose -f compose.prod.yml exec -T app php artisan migrate --force 2>/dev/null || \
    echo -e "${YELLOW}  ⚠️  Migrations may have already run${NC}"

# Clear caches
echo "  - Clearing application cache..."
docker compose -f compose.prod.yml exec -T app php artisan cache:clear 2>/dev/null || true
docker compose -f compose.prod.yml exec -T app php artisan config:cache 2>/dev/null || true
docker compose -f compose.prod.yml exec -T app php artisan view:clear 2>/dev/null || true

echo -e "${GREEN}✓ Migrations and cache cleared${NC}"
echo ""

# Step 7: Cleanup old images
echo -e "${YELLOW}🧹 Step 7/7: Cleaning up old Docker images...${NC}"
docker image prune -f --filter "until=168h" 2>/dev/null || true
echo -e "${GREEN}✓ Cleanup complete${NC}"
echo ""

# Final status
echo -e "${BLUE}==================================================${NC}"
echo -e "${GREEN}✅ Deployment successful!${NC}"
echo -e "${BLUE}==================================================${NC}"
echo ""
echo -e "${YELLOW}📋 Status:${NC}"
docker compose -f compose.prod.yml ps
echo ""
echo -e "${YELLOW}📝 Logs:${NC}"
docker compose -f compose.prod.yml logs --tail=20 app
echo ""
echo -e "${YELLOW}🌐 Application URL:${NC}"
CONTAINER_IP=$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' kema3-app 2>/dev/null || echo "localhost")
echo "  - HTTP: http://$CONTAINER_IP or http://$(hostname -I | awk '{print $1}')"
echo "  - Container IP: $CONTAINER_IP"
echo ""
echo -e "${YELLOW}📊 Docker Stats:${NC}"
docker stats --no-stream
echo ""
echo -e "${GREEN}Deployment complete! 🎉${NC}"
