
#!/bin/bash

# Secure Multi-Database Backup Script
BACKUP_DIR="/root/mk-website/bitami"
TIMESTAMP=$(date +"%Y-%m-%d_%H-%M-%S")
LOG_FILE="/root/mk-website/bitami/backup.log"
MYSQL_CONFIG="/etc/mysql/conf.d/backup.cnf"
# List of databases to backup
DATABASES=("eo-wp-blog", "eo-wp-ourwork", "eo-wp-insights", "default")  # Add your database names

mkdir -p /home/ubuntu
touch $LOG_FILE

log_message() {
    echo "[$(date +'%Y-%m-%d %H:%M:%S')] $1" | tee -a $LOG_FILE
}

cd $BACKUP_DIR || exit 1

log_message "Starting multi-database backup process..."

success_count=0
for db_name in "${DATABASES[@]}"; do
    log_message "Backing up database: $db_name"
    
    mysqldump --defaults-extra-file="$MYSQL_CONFIG" \
        --single-transaction \
        --set-gtid-purged=OFF \
        --routines \
        --events \
        --triggers \
        "$db_name" > "backup_${db_name}_${TIMESTAMP}.sql"
    
    if [ $? -eq 0 ] && [ -s "backup_${db_name}_${TIMESTAMP}.sql" ]; then
        log_message "SUCCESS: $db_name ($(wc -l < "backup_${db_name}_${TIMESTAMP}.sql") lines)"
        ((success_count++))
    else
        log_message "ERROR: Failed to backup $db_name"
    fi
done

if [ $success_count -gt 0 ]; then
    git add . && \
    git commit -m "Backup: $success_count databases - $TIMESTAMP" && \
    git push origin main && \
    log_message "Git operations completed successfully"
else
    log_message "ERROR: No databases were backed up successfully"
    exit 1
fi

# Cleanup old backups (keep 7 days)
find "$BACKUP_DIR" -name "backup_*.sql" -mtime +7 -delete
log_message "Cleaned up backups older than 7 days"

log_message "Backup process completed: $success_count/${#DATABASES[@]} databases"
