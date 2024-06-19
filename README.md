# wordpress-ecommerce
CICD Wordpress using Github Action

# Tham số thiết lập Servers
## Thiết lập EC2 Instance trên AWS
* 1.Tạo EC2 Instance:
    - Loại instance: t2.micro (Free Tier)
    - Hệ điều hành: Ubuntu 20.04 LTS
    - Key pair: Tạo một key pair mới hoặc sử dụng key pair hiện có (ví dụ: huydien.pem).
* 2.Cấu hình Security Group:
    - Mở các cổng:
    - SSH (Port 22): cho phép IP của bạn hoặc mở cho toàn thế giới (0.0.0.0/0) nếu cần.
    - HTTP (Port 80): cho phép toàn thế giới (0.0.0.0/0).
    - HTTPS (Port 443): cho phép toàn thế giới (0.0.0.0/0).
![image](https://github.com/idiotman-2212/wordpress-ecommerce/assets/82036270/f2082de1-8947-48b8-9cfe-512d4f287093)

# Tham số thiết lập cấu hình Reverse Proxy
## Cài đặt Apache và cấu hình Reverse Proxy
* 1.Cài đặt Apache
     <pre>
       sudo apt update
       sudo apt install apache2
     </pre>
* 2.Cài đặt các module cần thiết:
 <pre>
   sudo a2enmod proxy
   sudo a2enmod proxy_http
   sudo a2enmod rewrite
   sudo a2enmod ssl
 </pre>
* 3.Cấu hình Virtual Host cho Reverse Proxy:
- Tạo hoặc chỉnh sửa file cấu hình Virtual Host của Apache:
<pre>sudo nano /etc/apache2/sites-available/000-default.conf</pre>
- Nội dung file
<pre>
<VirtualHost *:80>
    ProxyPreserveHost On
    ProxyPass / http://localhost:8080/
    ProxyPassReverse / http://localhost:8080/

    <Directory /src/www/wordpress>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
</pre>
- Khởi động lại Apache:
<pre>sudo systemctl restart apache2</pre>

# Script và thông số thiết lập CI/CD
## Thiết lập CI/CD với GitHub Actions
* 1.Tạo workflow file:
- Tạo file .github/workflows/main.yml trong repository của bạn.
* 2.Nội dung file main.yml:
<pre>
name: Deploy to EC2new
on:
  push:
    branches:
      - main
jobs:
  deploy:
    runs-on: ubuntu-latest

    steps:
    - name: Checkout repository
      uses: actions/checkout@v2

    - name: Remove existing files on EC2
      uses: appleboy/ssh-action@master
      with:
        host: ${{ secrets.EC2_HOST }}
        username: ${{ secrets.EC2_USER }}
        key: ${{ secrets.EC2_PRIVATE_KEY }}
        script: |
          rm -rf /src/www/wordpress/*

    - name: Copy repository to EC2
      uses: appleboy/scp-action@master
      with:
        host: ${{ secrets.EC2_HOST }}
        username: ${{ secrets.EC2_USER }}
        key: ${{ secrets.EC2_PRIVATE_KEY }}
        source: "./*"
        target: "/src/www/wordpress/"

</pre>
## Thiết lập Secrets trên GitHub
* 1.Truy cập vào repository của bạn trên GitHub.
* 2.Đi tới Settings > Secrets > Actions.
* 3.Thêm các secrets sau:
     - EC2_HOST: Địa chỉ IP của instance EC2 (ví dụ: 52.91.49.55).
     - EC2_USER: Tên người dùng SSH (ví dụ: ubuntu).
     - EC2_PRIVATE_KEY: Nội dung của file huydien.pem.

# Liên kết tới repo chứa code sites, tài liệu, scripts
* Bạn cần lưu trữ code của bạn trên một repository GitHub. Đảm bảo rằng repository này chứa:
  - Mã nguồn của trang WordPress.
  - File cấu hình .github/workflows/main.yml.
  - Tài liệu hướng dẫn triển khai (có thể là file README.md).

# Chạy site(s) đã triển khai
* 1.Kết nối tới instance EC2 của bạn qua SSH:
<pre>ssh -i "huydien.pem" ubuntu@52.91.49.55</pre>
* 2.Cài đặt các thành phần cần thiết cho WordPress:
<pre>
sudo apt update
sudo apt install php php-mysql mysql-server
</pre>
* 3.Thiết lập cơ sở dữ liệu MySQL cho WordPress:
<pre> sudo mysql
</pre>
- Trong MySQL shell, tạo cơ sở dữ liệu và người dùng:
<pre> CREATE DATABASE wordpress;
CREATE USER 'wordpressuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON wordpress.* TO 'wordpressuser'@'localhost';
FLUSH PRIVILEGES;
EXIT;
</pre>
* 4.Cấu hình WordPress:
- Chỉnh sửa file wp-config.php để kết nối tới cơ sở dữ liệu.
<pre>
define('DB_NAME', 'wordpress');
define('DB_USER', 'wordpressuser');
define('DB_PASSWORD', 'password');
define('DB_HOST', 'localhost');
</pre>
* 5.Truy cập trang web:
- Mở trình duyệt và truy cập http://52.91.49.55 để hoàn tất cài đặt WordPress.

# Demo hoạt động của CI/CD
* 1.Đẩy thay đổi lên nhánh main của repository:
<pre>
git add .
git commit -m "Update code"
git push origin main
</pre>
* 2.Kiểm tra GitHub Actions:
- Truy cập vào tab Actions trên repository của bạn để xem quá trình CI/CD đang diễn ra.
- Đảm bảo rằng các bước trong workflow chạy thành công.

# Kết quả
![image](https://github.com/idiotman-2212/wordpress-ecommerce/assets/82036270/d3e6bd0e-6316-43b9-b20a-3a6fdb02e5d1)
