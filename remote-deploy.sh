#!/bin/bash
# 🚀 Remote Deployment Wrapper
# Run dari laptop untuk deploy ke EC2
# Usage: ./remote-deploy.sh

# Configuration
EC2_HOST="16.79.60.176"
EC2_USER="ubuntu"
EC2_KEY="$HOME/.ssh/your-key.pem"  # UPDATE INI!
DEPLOY_PATH="/home/ubuntu/kema3-jaga-4"

# Color
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${YELLOW}🚀 Deploying ke EC2: $EC2_HOST${NC}"
echo ""

# Check key exists
if [ ! -f "$EC2_KEY" ]; then
    echo -e "${RED}❌ Key not found: $EC2_KEY${NC}"
    echo "Update EC2_KEY variable di script ini!"
    exit 1
fi

# SSH dan jalankan deploy.sh
ssh -i "$EC2_KEY" "$EC2_USER@$EC2_HOST" "cd $DEPLOY_PATH && bash deploy.sh"

echo ""
echo -e "${GREEN}✅ Deployment selesai!${NC}"
