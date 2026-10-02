# 🚀 AWS Deployment Setup Guide

**Project:** kema3-jaga-4  
**Region:** ap-southeast-3 (Jakarta) *(atau sesuaikan jika berbeda)*  
**EC2:** 16.79.60.176 (ubuntu)

---

## 1️⃣ Setup AWS IAM & ECR

### A. Buat IAM User untuk GitHub Actions

1. Go to **AWS IAM Console** → **Users** → **Create user**
   - Username: `github-actions-deploy`
   - Next

2. Attach policies:
   - ✅ `AmazonEC2ContainerRegistryPowerUser` (untuk push image ke ECR)
   - ✅ `AmazonSSMManagedInstanceCore` (untuk EC2 deployment)

3. Create **Access Key**:
   - Go to **Security credentials** tab
   - Scroll to "Access keys" → **Create access key**
   - Choose: Application running outside AWS
   - Copy: `Access Key ID` dan `Secret Access Key`

### B. Buat ECR Repository

```bash
# Via AWS CLI
aws ecr create-repository \
  --repository-name kema3-jaga-4 \
  --region ap-southeast-3

# Output akan berisi: 123456789.dkr.ecr.ap-southeast-3.amazonaws.com/kema3-jaga-4
# Simpan ECR URL ini!
```

---

## 2️⃣ Setup EC2 Instance

### Prasyarat EC2:
- OS: Ubuntu 22.04 LTS atau lebih baru
- Size: t3.small minimum (atau t4g.small untuk ARM)
- Security Group: Allow SSH (22), HTTP (80), HTTPS (443)
- Public IP/Elastic IP: 16.79.60.176

### Install Dependencies di EC2

```bash
# SSH ke EC2
ssh -i /path/to/your/key.pem ubuntu@16.79.60.176

# Update system
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker ubuntu

# Install Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Verify
docker --version
docker-compose --version

# Setup app directory
mkdir -p ~/kema3-jaga-4
cd ~/kema3-jaga-4
```

### Create Deploy User (Optional but Recommended)

```bash
sudo useradd -m -s /bin/bash deployer
sudo usermod -aG docker deployer
sudo visudo
# Add: deployer ALL=(ALL) NOPASSWD: /usr/bin/systemctl
```

---

## 3️⃣ Setup GitHub Secrets

Go to: **GitHub Repo** → **Settings** → **Secrets and variables** → **Actions** → **New repository secret**

Add these secrets:

| Secret Name | Value | Where to get |
|------------|-------|--------------|
| `AWS_ACCESS_KEY_ID` | Your IAM Access Key | AWS IAM Console |
| `AWS_SECRET_ACCESS_KEY` | Your IAM Secret Key | AWS IAM Console |
| `AWS_REGION` | `ap-southeast-3` | Your AWS Region |
| `ECR_REGISTRY` | `123456789.dkr.ecr.ap-southeast-3.amazonaws.com` | Output dari ECR creation |
| `ECR_REPOSITORY` | `kema3-jaga-4` | ECR Repository name |
| `EC2_HOST` | `16.79.60.176` | Your EC2 Public IP |
| `EC2_USER` | `ubuntu` | Your EC2 SSH user |
| `EC2_PRIVATE_KEY` | *Content of .pem file* | Your EC2 Key Pair |
| `DEPLOY_PATH` | `/home/ubuntu/kema3-jaga-4` | Path di EC2 |

---

## 4️⃣ EC2 Deployment Script

Script ini akan di-run oleh GitHub Actions di EC2:

**File:** `.github/scripts/deploy.sh`

```bash
#!/bin/bash
set -e

REGISTRY=$1
REPOSITORY=$2
TAG=$3
DEPLOY_PATH=$4

echo "🚀 Deploying $REGISTRY/$REPOSITORY:$TAG to $DEPLOY_PATH"

# Go to app directory
cd $DEPLOY_PATH

# Login to ECR
aws ecr get-login-password --region ap-southeast-3 | docker login --username AWS --password-stdin $REGISTRY

# Pull latest image
docker pull $REGISTRY/$REPOSITORY:$TAG

# Stop old containers
docker compose down || true

# Create .env if not exist
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Created .env from .env.example - EDIT THIS FILE!"
fi

# Update docker-compose to use new image
export IMAGE_TAG=$TAG
docker compose -f compose.prod.yml up -d

# Cleanup old images
docker image prune -f --filter "until=168h"

echo "✅ Deployment complete!"
```

---

## 5️⃣ Verify Deployment

```bash
# SSH ke EC2
ssh -i /path/to/key.pem ubuntu@16.79.60.176

# Check containers
docker ps

# Check logs
docker compose logs -f app

# Test aplikasi
curl http://16.79.60.176

# Check nginx
docker compose ps

# If using domain + HTTPS:
# Configure nginx SSL in docker/nginx/
# Use Let's Encrypt via Certbot
```

---

## 🔑 Important Notes

1. **Environment Variables**: 
   - Perlu `.env` file di EC2 dengan database credentials
   - GitHub Actions akan create jika tidak ada, tapi Anda harus edit manual

2. **Database**:
   - Jika pakai RDS, update DB_HOST di .env
   - Jika pakai Docker Compose database service, pastikan persistent volume

3. **SSL/HTTPS**:
   - Setup Certbot di docker/nginx/ untuk Let's Encrypt
   - Atau gunakan AWS ALB/CloudFront

4. **Rollback**:
   ```bash
   # Untuk rollback ke image lama:
   docker compose down
   docker pull $REGISTRY/$REPOSITORY:$OLD_TAG
   docker compose -f compose.prod.yml up -d
   ```

---

## 🆘 Troubleshooting

**"ECR authentication failed"**
- Pastikan IAM user memiliki `AmazonEC2ContainerRegistryPowerUser`
- Verify Access Key ID/Secret

**"Permission denied while trying to connect to Docker"**
- Jalankan: `sudo usermod -aG docker $USER`
- Logout dan login lagi

**"docker-compose: command not found"**
- Install dengan script di atas, atau: `sudo apt install docker-compose`

**"Container exiting with code 1"**
- Check logs: `docker logs container_name`
- Pastikan .env file sudah benar

---

## 📚 Next Steps

1. ✅ Setup IAM & ECR (5 min)
2. ✅ Setup EC2 dengan Docker (10 min)  
3. ✅ Add GitHub Secrets (5 min)
4. ✅ Push GitHub Actions workflow (auto-trigger on push)
5. ✅ Monitor first deployment
