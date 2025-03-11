  #!/bin/bash

    # Đường dẫn thư mục dự án
    PROJECT_DIR="/var/www/biogold.online"
    GIT_REPO="https://github.com/hg-digital-company-limited/biogold.online.git"
    SQL_FILE="${PROJECT_DIR}/biogold.sql"
    DB_NAME="biogold"
    DB_USER="biogold"
    DB_PASSWORD="biogold"  # Thay đổi mật khẩu nếu cần

    # Xóa thư mục dự án
    sudo rm -rf ${PROJECT_DIR}/*
    sudo rm -rf ${PROJECT_DIR}/.[^.]*

    # Clone lại repo
    sudo git clone $GIT_REPO $PROJECT_DIR

    # Xóa và tạo lại database
    sudo mysql -e "\
    DROP DATABASE IF EXISTS $DB_NAME;\
    CREATE DATABASE $DB_NAME;\
    CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';\
    GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';\
    FLUSH PRIVILEGES;"

    # Nhập dữ liệu từ file SQL
    if [ -f "$SQL_FILE" ]; then
        sudo mysql -u $DB_USER -p$DB_PASSWORD $DB_NAME < $SQL_FILE
    else
        echo "File SQL không tồn tại: $SQL_FILE"
        exit 1
    fi

    # Cài đặt các gói Composer
    cd $PROJECT_DIR
    sudo composer install

    # Sao chép tệp .env
    if [ -f ".env.production" ]; then
        sudo cp .env.production .env
    else
        echo "File .env.production không tồn tại."
        exit 1
    fi

    # Phân quyền thư mục
    sudo chown -R www-data.www-data $PROJECT_DIR/storage
    sudo chown -R www-data.www-data $PROJECT_DIR/bootstrap/cache
    # Tạo symbolic link cho storage
    sudo php artisan storage:link

    echo "Triển khai hoàn tất."