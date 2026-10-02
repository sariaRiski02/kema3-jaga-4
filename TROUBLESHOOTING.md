# 🔧 CI/CD Troubleshooting Guide

## Common Issues & Solutions

### 1. GitHub Actions Workflow Issues

#### ❌ "Workflow failed at Test stage"

**Error: Database connection failed during tests**
```
Error: SQLSTATE[HY000] [2002] Connection refused
```

**Solution:**
- MySQL service harus running di workflow
- Check `.github/workflows/deploy.yml` → `services: mysql:`
- Pastikan `DB_HOST=127.0.0.1` di test environment

```yaml
services:
  mysql:
    image: mysql:8.0
    env:
      MYSQL_ROOT_PASSWORD: password
      MYSQL_DATABASE: kema3_test
    options: >-
      --health-cmd="mysqladmin ping"
      --health-interval=10s
      --health-timeout=5s
      --health-retries=3
```

---

#### ❌ "Workflow failed: ECR login failed"

**Error:**
```
Error: InvalidSignatureException: The request signature we calculated does not match
```

**Solution:**
1. Verify GitHub Secrets:
   - `AWS_ACCESS_KEY_ID` ✓
   - `AWS_SECRET_ACCESS_KEY` ✓
   - `AWS_REGION` (harus: `ap-southeast-3`)

2. Verify IAM permissions:
   ```bash
   # Di AWS Console → IAM → Users → github-actions-deploy
   # Attached policies → check AmazonEC2ContainerRegistryPowerUser
   ```

3. Regenerate Access Key jika sudah lama:
   - Delete old key
   - Create new access key
   - Update GitHub Secrets

---

#### ❌ "Build image step: docker: not found"

**Solution:**
- GitHub Actions sudah include Docker
- Pastikan `runs-on: ubuntu-latest`
- Setup Docker Buildx:
  ```yaml
  - uses: docker/setup-buildx-action@v2
  ```

---

### 2. ECR (Elastic Container Registry) Issues

#### ❌ "No repository with name 'kema3-jaga-4' found"

**Solution:**
1. Go to AWS Console → ECR
2. Create repository:
   ```bash
   aws ecr create-repository \
     --repository-name kema3-jaga-4 \
     --region ap-southeast-3
   ```
3. Update GitHub Secrets `ECR_REGISTRY` & `ECR_REPOSITORY`

---

#### ❌ "Image push failed: Access denied"

**Solution:**
1. Verify ECR_REGISTRY format:
   ```
   ✓ Correct: 123456789.dkr.ecr.ap-southeast-3.amazonaws.com
   ✗ Wrong: dkr.ecr.ap-southeast-3.amazonaws.com/kema3-jaga-4
   ```

2. IAM user permissions:
   - Must have: `AmazonEC2ContainerRegistryPowerUser`
   - Or create custom policy with `ecr:*` actions

---

### 3. EC2 Deployment Issues

#### ❌ "SSH: Connection refused"

**Solution:**
1. Verify EC2 security group:
   - Allow inbound SSH (port 22)
   - Source: Your IP or 0.0.0.0/0

2. Check key permissions:
   ```bash
   # On your laptop
   chmod 600 your-key.pem
   ssh -i your-key.pem -vvv ubuntu@16.79.60.176
   ```

3. Wrong user:
   - Amazon Linux: `ec2-user`
   - Ubuntu: `ubuntu`
   - Check what's correct for your AMI

---

#### ❌ "Authentication failed (private key)"

**Error di GitHub Actions:**
```
Permission denied (publickey)
```

**Solution:**
1. Verify EC2_PRIVATE_KEY secret:
   ```bash
   # On laptop - copy full .pem content
   cat /path/to/your/aws-key.pem
   ```

2. Paste ENTIRE content including:
   ```
   -----BEGIN RSA PRIVATE KEY-----
   ...
   -----END RSA PRIVATE KEY-----
   ```

3. No extra spaces or line breaks

---

#### ❌ "Docker: command not found" on EC2

**Solution:**
```bash
# SSH to EC2 and reinstall
ssh -i your-key.pem ubuntu@16.79.60.176

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Add user to docker group
sudo usermod -aG docker ubuntu

# Logout & login again
exit
ssh -i your-key.pem ubuntu@16.79.60.176

# Verify
docker ps
```

---

#### ❌ "Permission denied: /home/ubuntu/kema3-jaga-4"

**Solution:**
```bash
# On EC2
sudo chown -R ubuntu:ubuntu /home/ubuntu/kema3-jaga-4
sudo chmod -R 755 /home/ubuntu/kema3-jaga-4
```

---

### 4. Docker Container Issues

#### ❌ "docker-compose: command not found"

**Solution:**
```bash
# On EC2
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" \
  -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Verify
docker-compose --version
```

Or use new syntax:
```bash
docker compose version  # (without hyphen)
```

---

#### ❌ "Container exiting with code 1"

**Debug:**
```bash
# Check logs
docker compose -f compose.prod.yml logs app

# Common issues:
# - APP_KEY not set (run: php artisan key:generate)
# - Database not accessible
# - Missing required PHP extensions
```

---

#### ❌ "Cannot connect to Docker daemon"

**Solution:**
```bash
# Check if Docker is running
sudo systemctl status docker

# Start Docker
sudo systemctl start docker
sudo systemctl enable docker

# Check permissions
groups ubuntu  # Should show: ubuntu docker

# If not, add user to group
sudo usermod -aG docker ubuntu
```

---

#### ❌ "Failed to pull image from ECR"

**Error:**
```
no basic auth credentials
```

**Solution:**
```bash
# On EC2 - re-authenticate to ECR
aws ecr get-login-password --region ap-southeast-3 | \
  docker login --username AWS --password-stdin 123456789.dkr.ecr.ap-southeast-3.amazonaws.com

# Verify credentials saved
cat ~/.docker/config.json  # Should show ECR registry
```

---

#### ❌ "nginx: error while loading shared libraries"

**Solution:**
- Use official nginx image: `nginx:alpine`
- Or ensure Dockerfile has proper base image
- Check compose.prod.yml:
  ```yaml
  nginx:
    image: nginx:alpine  # ✓
    # NOT: image: nginx:latest
  ```

---

### 5. Laravel Application Issues

#### ❌ "SQLSTATE[HY000] [2002] Connection refused"

**Solution:**
```bash
# 1. Check .env file on EC2
ssh -i your-key.pem ubuntu@16.79.60.176
cat ~/kema3-jaga-4/.env | grep DB_

# 2. Verify database is running/accessible
# If using RDS:
mysql -h your-rds-endpoint.rds.amazonaws.com -u admin -p

# If using Docker MySQL:
docker compose -f compose.prod.yml exec mysql mysql -u root -p
```

---

#### ❌ "No application encryption key has been specified"

**Solution:**
```bash
# In EC2
cd ~/kema3-jaga-4
docker compose -f compose.prod.yml exec app php artisan key:generate

# Copy output and add to .env
# APP_KEY=base64:...

# Restart app
docker compose -f compose.prod.yml restart app
```

---

#### ❌ "Call to undefined function ..." during migrations

**Solution:**
```bash
# Missing PHP extension
# Update Dockerfile to include required extension
# For example, gd, intl, etc.

# Then rebuild and deploy:
git add Dockerfile
git commit -m "fix: add missing PHP extension"
git push origin main
# GitHub Actions will handle rest
```

---

### 6. Monitoring & Debugging

#### Check All Logs

```bash
# Application logs
docker compose -f compose.prod.yml logs app

# Nginx logs
docker compose -f compose.prod.yml logs nginx

# Laravel logs
docker compose -f compose.prod.yml exec app tail -f storage/logs/laravel.log

# System Docker logs
docker compose -f compose.prod.yml logs

# Specific service (last 100 lines)
docker compose -f compose.prod.yml logs --tail=100 app

# Follow logs in real-time
docker compose -f compose.prod.yml logs -f
```

#### Check Container Health

```bash
# Detailed container info
docker inspect kema3-app

# Check running processes in container
docker compose -f compose.prod.yml exec app ps aux

# Execute command in container
docker compose -f compose.prod.yml exec app php artisan tinker
```

#### Database Connection Test

```bash
# From inside app container
docker compose -f compose.prod.yml exec app php -r "
  \$db = \mysqli_connect(
    getenv('DB_HOST'),
    getenv('DB_USERNAME'),
    getenv('DB_PASSWORD'),
    getenv('DB_DATABASE')
  );
  if (\$db) echo 'Connected!'; 
  else echo 'Failed: ' . \mysqli_connect_error();
"
```

---

### 7. Rollback Deployment

**If deployment breaks:**

```bash
# Option 1: Rollback to previous image
cd ~/kema3-jaga-4
docker pull 123456789.dkr.ecr.ap-southeast-3.amazonaws.com/kema3-jaga-4:previous-tag
export IMAGE=123456789.dkr.ecr.ap-southeast-3.amazonaws.com/kema3-jaga-4:previous-tag
docker compose -f compose.prod.yml up -d

# Option 2: Stop containers and check what's wrong
docker compose -f compose.prod.yml down
docker compose -f compose.prod.yml logs
# Fix issue, then:
docker compose -f compose.prod.yml up -d

# Option 3: Full reset (DANGEROUS)
docker compose -f compose.prod.yml down -v  # Remove all volumes!
git pull origin main
docker compose -f compose.prod.yml up -d
```

---

### 8. Performance Issues

#### "App is slow/timeout"

```bash
# Check Docker resource limits
docker stats kema3-app

# Check nginx performance
docker compose -f compose.prod.yml logs nginx | grep "upstream timed out"

# Increase fastcgi timeout in nginx config
# docker/nginx/conf.d/default.conf:
# fastcgi_read_timeout 120s;
```

---

## ✅ Health Check Commands

Run these to verify everything is working:

```bash
# 1. Docker is running
docker ps

# 2. Containers are healthy
docker compose -f compose.prod.yml ps

# 3. App is responding
curl http://localhost

# 4. Database is connected
docker compose -f compose.prod.yml exec app php artisan tinker
# Type: exit;

# 5. Migrations are up-to-date
docker compose -f compose.prod.yml exec app php artisan migrate:status

# 6. Laravel is configured
docker compose -f compose.prod.yml exec app php artisan config:show | grep APP_ENV

# 7. Check error logs
docker compose -f compose.prod.yml logs | tail -20
```

---

## 🆘 Get Help

1. **Check logs first:**
   ```bash
   docker compose -f compose.prod.yml logs
   ```

2. **Search errors:**
   - Google the error message
   - Check Laravel docs
   - Check Docker docs

3. **Ask on forums:**
   - Laravel Laracasts
   - Stack Overflow (tag: laravel, docker)
   - GitHub Issues

4. **Report deployment script issues:**
   - Check `.github/workflows/deploy.yml`
   - Check `.github/scripts/deploy.sh`
   - Run deployment manually for more info

---

**Remember:** Most issues are environment configuration related. Always check `.env` file first! 🎯
