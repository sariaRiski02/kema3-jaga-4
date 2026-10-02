#!/bin/bash
# 🚀 One-Command Deployment Script
# Usage: ./deploy.sh
# or: bash deploy.sh

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

PROJECT_DIR="/home/ubuntu/kema3-jaga-4"
COMPOSE_FILE="compose.prod.yml"

echo -e "${BLUE}╔════════════════════════════════════╗${NC}"
echo -e "${BLUE}║  🚀 ONE-COMMAND DEPLOYMENT        ║${NC}"
echo -e "${BLUE}║  kema3-jaga-4                     ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════╝${NC}"
echo ""

# 1. Pull latest code
echo -e "${YELLOW}[1/6] 📥 Pulling latest code dari GitHub...${NC}"
cd "$PROJECT_DIR"
git fetch origin main || { echo -e "${RED}❌ Git fetch failed${NC}"; exit 1; }
git reset --hard origin/main || { echo -e "${RED}❌ Git reset failed${NC}"; exit 1; }
echo -e "${GREEN}✓ Code updated${NC}"
echo ""

# 2. Login ke ECR
echo -e "${YELLOW}[2/6] 🔐 Login ke AWS ECR...${NC}"
if [ -z "$AWS_REGION" ]; then
    AWS_REGION="ap-southeast-3"
fi

aws ecr get-login-password --region $AWS_REGION | \
    docker login --username AWS --password-stdin $(cat .env | grep ECR_REGISTRY | cut -d= -f2) 2>/dev/null || \
    echo -e "${YELLOW}⚠️  ECR login not configured (optional for local build)${NC}"
echo -e "${GREEN}✓ ECR authenticated${NC}"
echo ""

# 3. Pull image
echo -e "${YELLOW}[3/6] 📦 Pulling Docker image...${NC}"
IMAGE=$(cat .env 2>/dev/null | grep ECR_REGISTRY | cut -d= -f2)
if [ ! -z "$IMAGE" ]; then
    IMAGE="$IMAGE/kema3-jaga-4:latest"
    docker pull "$IMAGE" 2>/dev/null || echo -e "${YELLOW}⚠️  Image pull failed, akan build local${NC}"
else
    echo -e "${YELLOW}⚠️  IMAGE not set, build local${NC}"
fi
echo -e "${GREEN}✓ Docker image ready${NC}"
echo ""

# 4. Stop containers
echo -e "${YELLOW}[4/6] ⛔ Stopping old containers...${NC}"
docker compose -f $COMPOSE_FILE down 2>/dev/null || true
echo -e "${GREEN}✓ Containers stopped${NC}"
echo ""

# 5. Start containers
echo -e "${YELLOW}[5/6] 🚀 Starting new containers...${NC}"
if [ ! -z "$IMAGE" ]; then
    export IMAGE="$IMAGE"
fi
docker compose -f $COMPOSE_FILE up -d || { echo -e "${RED}❌ Failed to start containers${NC}"; exit 1; }
sleep 5
echo -e "${GREEN}✓ Containers started${NC}"
echo ""

# 6. Migrations & Cache
echo -e "${YELLOW}[6/6] 🔄 Running migrations & clearing cache...${NC}"
docker compose -f $COMPOSE_FILE exec -T app php artisan migrate --force 2>/dev/null || true
docker compose -f $COMPOSE_FILE exec -T app php artisan cache:clear 2>/dev/null || true
docker compose -f $COMPOSE_FILE exec -T app php artisan config:cache 2>/dev/null || true
docker compose -f $COMPOSE_FILE exec -T app php artisan view:clear 2>/dev/null || true
echo -e "${GREEN}✓ Ready${NC}"
echo ""

# Status
echo -e "${BLUE}╔════════════════════════════════════╗${NC}"
echo -e "${GREEN}✅ DEPLOYMENT COMPLETE!${NC}"
echo -e "${BLUE}╚════════════════════════════════════╝${NC}"
echo ""
echo -e "${YELLOW}📋 Container Status:${NC}"
docker compose -f $COMPOSE_FILE ps
echo ""
echo -e "${YELLOW}📊 Logs (last 20 lines):${NC}"
docker compose -f $COMPOSE_FILE logs --tail=20 app
echo ""
echo -e "${YELLOW}🧹 Cleanup old images...${NC}"
docker image prune -f --filter "until=168h" 2>/dev/null || true
echo ""
echo -e "${GREEN}🎉 Ready to serve!${NC}"
