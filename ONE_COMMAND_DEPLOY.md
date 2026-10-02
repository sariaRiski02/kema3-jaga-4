# ⚡ One-Command Deployment Guide

**Deploy dengan 1 command!**

---

## 🎯 Workflow

### Opsi 1: Deploy dari Server EC2 (SSH ke server)

```bash
# 1. SSH ke EC2
ssh -i your-key.pem ubuntu@16.79.60.176

# 2. Go to project
cd /home/ubuntu/kema3-jaga-4

# 3. Jalankan deploy (hanya ini!)
bash deploy.sh
```

✅ **Done!** Aplikasi sudah update dan running.

---

### Opsi 2: Deploy dari Laptop (Automatic)

```bash
# 1. Di laptop, buka project folder
cd ~/project/kema3-jaga-4

# 2. Edit remote-deploy.sh - set path key:
nano remote-deploy.sh
# Change: EC2_KEY="$HOME/.ssh/your-key.pem"

# 3. Make executable
chmod +x remote-deploy.sh

# 4. Run deploy (hanya ini!)
./remote-deploy.sh
```

✅ **Done!** Script otomatis SSH, pull code, dan deploy.

---

## 🔧 Setup First Time

### Step 1: Buat .env di server

```bash
# SSH ke server
ssh -i your-key.pem ubuntu@16.79.60.176

# Create .env
cd /home/ubuntu/kema3-jaga-4
cp .env.example .env

# Edit dengan credentials
nano .env

# Required settings:
# APP_KEY=base64:xxxxx (generate dengan: php artisan key:generate)
# APP_URL=http://16.79.60.176
# DB_HOST=localhost
# DB_DATABASE=kema3
# DB_USERNAME=root
# DB_PASSWORD=password
```

### Step 2: Make deploy.sh executable

```bash
chmod +x /home/ubuntu/kema3-jaga-4/deploy.sh
```

### Step 3: First deploy

```bash
cd /home/ubuntu/kema3-jaga-4
bash deploy.sh
```

---

## 📋 What deploy.sh Does

1. ✅ Pull latest code dari GitHub (`git pull`)
2. ✅ Login ke AWS ECR (jika configured)
3. ✅ Pull Docker image terbaru
4. ✅ Stop containers lama
5. ✅ Start containers baru
6. ✅ Run database migrations
7. ✅ Clear caches
8. ✅ Cleanup old images

**Total time:** ~2-3 menit (first time lebih lama)

---

## 🚀 Usage Examples

### Example 1: Simple deploy via SSH

```bash
ssh ubuntu@16.79.60.176 "cd /home/ubuntu/kema3-jaga-4 && bash deploy.sh"
```

### Example 2: Deploy with auto-logout

```bash
ssh -i ~/.ssh/aws-key.pem ubuntu@16.79.60.176 << 'EOF'
cd /home/ubuntu/kema3-jaga-4
bash deploy.sh
exit
EOF
```

### Example 3: Deploy & show logs

```bash
ssh ubuntu@16.79.60.176 "cd /home/ubuntu/kema3-jaga-4 && bash deploy.sh && docker compose -f compose.prod.yml logs -f"
```

---

## 🆘 Troubleshooting

### "Permission denied" saat run deploy.sh

```bash
chmod +x /home/ubuntu/kema3-jaga-4/deploy.sh
bash deploy.sh
```

### "Container exits immediately"

```bash
docker compose -f compose.prod.yml logs app
# Check error message
```

### "git: command not found"

```bash
sudo apt install -y git
cd /home/ubuntu/kema3-jaga-4
git config --global user.email "you@example.com"
git config --global user.name "Your Name"
```

### "docker: permission denied"

```bash
sudo usermod -aG docker ubuntu
# Logout SSH dan login lagi
exit
ssh ubuntu@16.79.60.176
```

---

## 📝 Script Details

### deploy.sh

- Lokasi: `/home/ubuntu/kema3-jaga-4/deploy.sh`
- Run on: EC2 server
- Requirements: Docker, docker-compose, git
- Input: None (uses .env)
- Output: Container status & logs

### remote-deploy.sh

- Lokasi: Laptop Anda
- Run on: Laptop
- Requirements: SSH key to EC2
- Input: EC2 IP, user, key path
- Output: Deployment logs via SSH

---

## ⚙️ Customization

### Change deploy directory

Edit di `deploy.sh`:
```bash
PROJECT_DIR="/home/ubuntu/kema3-jaga-4"  # Change this
```

### Change git branch

Edit di `deploy.sh`:
```bash
git reset --hard origin/main  # Change 'main' ke branch lain
```

### Add custom commands

Edit di `deploy.sh`, tambah sebelum "Done":
```bash
# Custom command
docker compose -f $COMPOSE_FILE exec -T app php artisan some:command
```

### Use different compose file

Edit di `deploy.sh`:
```bash
COMPOSE_FILE="compose.prod.yml"  # Change this
```

---

## 🎯 Workflow Best Practices

1. **Always test locally first**
   ```bash
   composer test
   ```

2. **Commit before deploy**
   ```bash
   git add .
   git commit -m "feat: add new feature"
   git push origin main
   ```

3. **Monitor after deploy**
   ```bash
   ssh ubuntu@16.79.60.176 "docker compose -f compose.prod.yml logs -f app"
   ```

4. **Rollback jika ada masalah**
   ```bash
   ssh ubuntu@16.79.60.176 "cd /home/ubuntu/kema3-jaga-4 && git revert HEAD && bash deploy.sh"
   ```

---

## 📊 Monitoring

### Check app status

```bash
ssh ubuntu@16.79.60.176 "docker compose -f compose.prod.yml ps"
```

### View logs

```bash
ssh ubuntu@16.79.60.176 "docker compose -f compose.prod.yml logs -f app"
```

### Check server health

```bash
ssh ubuntu@16.79.60.176 "docker stats --no-stream"
```

---

## 🔐 Security Tips

1. **Never commit .env file**
   ```bash
   # .gitignore should have:
   .env
   .env.local
   ```

2. **Use strong passwords** di .env DB_PASSWORD

3. **Limit SSH access**
   - Security Group: Allow SSH only from your IP

4. **Backup database regularly**
   ```bash
   docker compose -f compose.prod.yml exec mysql mysqldump -u root -p > backup.sql
   ```

---

## ✅ Checklist Sebelum Deploy Pertama

- [ ] EC2 sudah setup Docker & docker-compose
- [ ] Code sudah di GitHub
- [ ] .env file sudah di EC2 dengan credentials
- [ ] deploy.sh bisa di-execute
- [ ] Database sudah siap (RDS atau container)
- [ ] APP_KEY sudah generate

---

## 🎉 Ready!

Sekarang tinggal:

```bash
# Dari laptop
ssh ubuntu@16.79.60.176 "cd /home/ubuntu/kema3-jaga-4 && bash deploy.sh"
```

**Done!** 🚀
