# ⚡ QUICK REFERENCE - One-Command Deploy

## 🚀 Cara Deploy (Pilih salah satu)

### ✅ Cara 1: Dari Laptop (Recommended)

```bash
ssh -i ~/.ssh/your-key.pem ubuntu@16.79.60.176 "cd /home/ubuntu/kema3-jaga-4 && bash deploy.sh"
```

**Done!** Tunggu 2-3 menit sampai selesai.

---

### ✅ Cara 2: SSH ke Server Dulu

```bash
# 1. SSH ke server
ssh -i ~/.ssh/your-key.pem ubuntu@16.79.60.176

# 2. Deploy (satu command ini!)
cd /home/ubuntu/kema3-jaga-4 && bash deploy.sh

# 3. Exit
exit
```

---

### ✅ Cara 3: GitHub Actions (Otomatis)

```bash
# Di laptop
git add .
git commit -m "update"
git push origin main

# GitHub Actions akan otomatis test, build, push ECR, dan deploy!
# Lihat progress: GitHub → Actions
```

---

## 📋 Yang Dilakukan `deploy.sh`

1. Pull latest code dari GitHub
2. Login ke AWS ECR  
3. Pull Docker image
4. Stop & start containers
5. Run migrations
6. Clear cache
7. Done! ✅

---

## 🔧 Setup Pertama (Hanya 1x)

### Di EC2:

```bash
ssh -i ~/.ssh/your-key.pem ubuntu@16.79.60.176

# Setup folder
mkdir -p /home/ubuntu/kema3-jaga-4
cd /home/ubuntu/kema3-jaga-4

# Clone project
git clone https://github.com/sariaRiski02/kema3-jaga-4.git .

# Setup environment
cp .env.example .env
nano .env

# Required: edit APP_KEY, DB_HOST, DB_NAME, etc

# Make script executable
chmod +x deploy.sh

# First deploy
bash deploy.sh
```

---

## 📝 Environment Setup (.env)

```bash
APP_KEY=base64:xxxxx_generate_dengan_php_artisan_key_generate
APP_URL=http://16.79.60.176
DB_HOST=localhost
DB_DATABASE=kema3
DB_USERNAME=root
DB_PASSWORD=your_password
```

**Generate APP_KEY:**
```bash
docker compose -f compose.prod.yml exec app php artisan key:generate
```

---

## ✅ Verify Deployment

```bash
# Check containers
ssh ubuntu@16.79.60.176 "docker compose -f compose.prod.yml ps"

# View logs
ssh ubuntu@16.79.60.176 "docker compose -f compose.prod.yml logs"

# Test aplikasi
curl http://16.79.60.176
```

---

## 🎯 Files Created

| File | Purpose |
|------|---------|
| `deploy.sh` | Jalankan di server, auto deploy |
| `remote-deploy.sh` | SSH & deploy dari laptop |
| `.github/workflows/deploy.yml` | GitHub Actions automation |
| `.github/scripts/deploy.sh` | GitHub Actions deployment script |
| `ONE_COMMAND_DEPLOY.md` | Dokumentasi lengkap |
| `AWS_SETUP.md` | Setup AWS (ECR, IAM, EC2) |
| `DEPLOYMENT_QUICKSTART.md` | Setup guide step-by-step |
| `TROUBLESHOOTING.md` | Troubleshooting common issues |

---

## 🔐 GitHub Secrets Required (untuk CI/CD otomatis)

Add ke: GitHub → Settings → Secrets and variables → Actions

```
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
AWS_REGION=ap-southeast-3
ECR_REGISTRY=123456789.dkr.ecr.ap-southeast-3.amazonaws.com
ECR_REPOSITORY=kema3-jaga-4
EC2_HOST=16.79.60.176
EC2_USER=ubuntu
EC2_PRIVATE_KEY=[content of .pem file]
DEPLOY_PATH=/home/ubuntu/kema3-jaga-4
```

---

## 🚀 TL;DR - Quickest Way

**Jalankan ini di laptop:**

```bash
# First time setup (only once)
ssh -i ~/.ssh/aws-key.pem ubuntu@16.79.60.176 << 'EOF'
mkdir -p /home/ubuntu/kema3-jaga-4
cd /home/ubuntu/kema3-jaga-4
git clone https://github.com/sariaRiski02/kema3-jaga-4.git .
cp .env.example .env
nano .env  # Edit ini dengan credentials Anda
bash deploy.sh
EOF

# Deploy selanjutnya (setiap kali ada update)
ssh -i ~/.ssh/aws-key.pem ubuntu@16.79.60.176 "cd /home/ubuntu/kema3-jaga-4 && bash deploy.sh"
```

---

## 📞 Help

Lihat dokumentasi lengkap:
- `ONE_COMMAND_DEPLOY.md` - Panduan lengkap
- `AWS_SETUP.md` - Setup AWS
- `TROUBLESHOOTING.md` - Error solutions
- `DEPLOYMENT_QUICKSTART.md` - Step-by-step setup

---

**🎉 Happy Deploying! One command, semua berubah!**
