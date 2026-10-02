# 🚀 Quick Start Guide: Deploy to AWS EC2 dengan Docker

**Project:** kema3-jaga-4  
**Target:** EC2 Ubuntu (16.79.60.176)  
**Time to Deploy:** ~30 minutes (first time)

---

## 📋 Checklist Setup (Do These Steps In Order)

### ✅ Phase 1: AWS Setup (15-20 minutes)

**Step 1.1: Create IAM User**
```bash
# Go to AWS Console → IAM → Users → Create User
# Username: github-actions-deploy
# Enable console access: NO
# Next → Permissions

# Select: AmazonEC2ContainerRegistryPowerUser
# Next → Create User
```

**Step 1.2: Create Access Keys for IAM User**
```bash
# IAM Console → Users → github-actions-deploy
# Security Credentials tab → Create Access Key
# Application running outside AWS
# Copy both Key ID and Secret Key somewhere safe!
```

**Step 1.3: Create ECR Repository**
```bash
# AWS Console → ECR (Elastic Container Registry)
# Repositories → Create Repository

# Repository name: kema3-jaga-4
# Image tag mutability: Disabled
# Scan on push: Enabled (recommended)
# Create

# 🎯 SAVE THIS URL: 123456789.dkr.ecr.ap-southeast-3.amazonaws.com/kema3-jaga-4
```

---

### ✅ Phase 2: EC2 Setup (10-15 minutes)

**Step 2.1: SSH ke EC2 dan Install Docker**

```bash
# From your laptop
ssh -i your-key.pem ubuntu@16.79.60.176

# Di EC2:
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker ubuntu

# Logout dan login kembali
exit
ssh -i your-key.pem ubuntu@16.79.60.176

# Verify Docker
docker --version
docker ps

# Install Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Verify
docker-compose --version
```

**Step 2.2: Install AWS CLI di EC2**

```bash
# Di EC2
sudo apt install -y awscli

# Configure AWS credentials (from Step 1.2)
aws configure
# AWS Access Key ID: paste_dari_step_1_2
# AWS Secret Access Key: paste_dari_step_1_2
# Default region: ap-southeast-3
# Default output format: json

# Test
aws ecr describe-repositories --region ap-southeast-3
```

**Step 2.3: Setup App Directory**

```bash
# Di EC2
mkdir -p ~/kema3-jaga-4
cd ~/kema3-jaga-4

# Download project dari GitHub (atau git clone)
git clone https://github.com/sariaRiski02/kema3-jaga-4.git .

# Atau jika sudah ada file, copy ke folder ini
# cp -r /path/to/local/project/* ~/kema3-jaga-4/
```

---

### ✅ Phase 3: GitHub Setup (5 minutes)

**Step 3.1: Add GitHub Secrets**

Go to: **GitHub** → Your Repository → **Settings** → **Secrets and variables** → **Actions**

Click **New repository secret** dan add:

```
AWS_ACCESS_KEY_ID
  Value: [Dari Step 1.2 - Access Key ID]

AWS_SECRET_ACCESS_KEY
  Value: [Dari Step 1.2 - Secret Access Key]

AWS_REGION
  Value: ap-southeast-3

ECR_REGISTRY
  Value: 123456789.dkr.ecr.ap-southeast-3.amazonaws.com

ECR_REPOSITORY
  Value: kema3-jaga-4

EC2_HOST
  Value: 16.79.60.176

EC2_USER
  Value: ubuntu

EC2_PRIVATE_KEY
  Value: [FULL CONTENT of your .pem private key file]

DEPLOY_PATH
  Value: /home/ubuntu/kema3-jaga-4
```

**Cara copy EC2_PRIVATE_KEY:**
```bash
# Di laptop Anda (jangan di EC2)
cat /path/to/your/aws-key.pem
# Copy seluruh isi, mulai dari -----BEGIN hingga -----END
```

---

### ✅ Phase 4: Test & Deploy (Pertama kali)

**Step 4.1: Manual Deploy Test**

```bash
# Di EC2
cd ~/kema3-jaga-4

# Copy environment file
cp .env.example .env

# EDIT .env dengan credentials yang benar
nano .env

# Minimal settings di .env:
# APP_KEY=base64:your_key_here
# APP_URL=http://16.79.60.176
# DB_HOST=localhost  (atau hostname database Anda)
# DB_DATABASE=kema3
# DB_USERNAME=user
# DB_PASSWORD=password

# Test build manual
docker pull 123456789.dkr.ecr.ap-southeast-3.amazonaws.com/kema3-jaga-4:latest

# Or start with local build first
docker compose -f compose.prod.yml up -d

# Check logs
docker logs kema3-app
```

**Step 4.2: Trigger GitHub Actions**

```bash
# Di laptop Anda
git add .
git commit -m "chore: setup CI/CD deployment"
git push origin main

# GitHub akan otomatis:
# 1. ✅ Run tests
# 2. ✅ Build Docker image
# 3. ✅ Push ke ECR
# 4. ✅ Deploy ke EC2

# Monitor di: GitHub → Actions
```

**Step 4.3: Verify Deployment**

```bash
# Di EC2
docker ps
docker compose -f compose.prod.yml ps

# Test aplikasi
curl http://localhost

# Full logs
docker compose -f compose.prod.yml logs
```

---

## 🔧 Configuration Details

### Database Setup

**Option A: External Database (AWS RDS)**
```bash
# Di .env:
DB_HOST=kema3-instance.crxxxxxxxxx.ap-southeast-3.rds.amazonaws.com
DB_PORT=3306
DB_DATABASE=kema3_prod
DB_USERNAME=admin
DB_PASSWORD=your_secure_password
```

**Option B: Database Container (Dalam Compose)**
Add ke `compose.prod.yml`:
```yaml
  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root_password
      MYSQL_DATABASE: kema3
      MYSQL_USER: kema3
      MYSQL_PASSWORD: kema3_password
    volumes:
      - mysql_data:/var/lib/mysql
    networks:
      - laravel

volumes:
  mysql_data:
    driver: local
```

### Generate Laravel Key

```bash
# Di EC2
docker compose -f compose.prod.yml exec app php artisan key:generate

# Copy output dan paste ke .env APP_KEY
```

---

## 📊 Monitoring & Logs

```bash
# Real-time logs
docker compose -f compose.prod.yml logs -f

# App logs only
docker compose -f compose.prod.yml logs app

# Last 50 lines
docker compose -f compose.prod.yml logs --tail=50

# Container stats
docker stats

# List containers
docker ps -a

# Check specific container
docker inspect kema3-app
```

---

## 🆘 Troubleshooting

**"Connection refused" ke database**
- Check DB_HOST, DB_PORT di .env
- Test: `mysql -h DB_HOST -u DB_USER -p`
- Jika RDS, pastikan security group allow port 3306

**"App container exits immediately"**
```bash
docker logs kema3-app
# Cek error message di output
```

**"Permission denied" saat docker**
```bash
# Run ini di EC2:
sudo usermod -aG docker ubuntu
# Logout SSH dan login kembali
```

**"ECR authentication failed"**
```bash
# Re-authenticate
aws ecr get-login-password --region ap-southeast-3 | \
  docker login --username AWS --password-stdin 123456789.dkr.ecr.ap-southeast-3.amazonaws.com
```

---

## 🎯 Next Steps

1. ✅ Complete setup checklist di atas
2. ✅ Test deployment (push ke GitHub main branch)
3. ✅ Monitor GitHub Actions
4. ✅ Verify di EC2
5. ✅ Set up domain + SSL (nginx config sudah siap)
6. ✅ Configure monitoring/alerts

---

## 📞 Support

- **GitHub Actions Docs:** https://docs.github.com/en/actions
- **AWS ECR Docs:** https://docs.aws.amazon.com/ecr/
- **Docker Compose Docs:** https://docs.docker.com/compose/
- **Laravel Deployment:** https://laravel.com/docs/deployment

---

**Happy Deploying! 🚀**
