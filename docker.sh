#!/bin/bash

# BlogBreeze Docker Management Script
# This script helps you manage the Docker containers for development

set -e

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Function to print colored messages
print_info() {
    echo -e "${BLUE}ℹ ${1}${NC}"
}

print_success() {
    echo -e "${GREEN}✓ ${1}${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ ${1}${NC}"
}

print_error() {
    echo -e "${RED}✗ ${1}${NC}"
}

# Function to check if Docker is running
check_docker() {
    if ! docker info > /dev/null 2>&1; then
        print_error "Docker is not running. Please start Docker first."
        exit 1
    fi
}

# Function to start containers
start() {
    print_info "Starting BlogBreeze containers..."
    docker-compose up -d
    
    print_success "Containers started!"
    echo ""
    print_info "Services are available at:"
    echo "  - Website:     http://localhost:8080"
    echo "  - PHPMyAdmin:  http://localhost:8081"
    echo ""
    print_info "View logs with: ./docker.sh logs"
}

# Function to stop containers
stop() {
    print_info "Stopping BlogBreeze containers..."
    docker-compose down
    print_success "Containers stopped!"
}

# Function to restart containers
restart() {
    print_info "Restarting BlogBreeze containers..."
    docker-compose restart
    print_success "Containers restarted!"
}

# Function to view logs
logs() {
    if [ -z "$1" ]; then
        docker-compose logs -f
    else
        docker-compose logs -f "$1"
    fi
}

# Function to show status
status() {
    print_info "Container status:"
    docker-compose ps
}

# Function to rebuild containers
rebuild() {
    print_info "Rebuilding containers..."
    docker-compose up -d --build
    print_success "Containers rebuilt!"
}

# Function to reset database
reset_db() {
    print_warning "This will DELETE all database data!"
    read -p "Are you sure? (yes/no): " -r
    echo
    if [[ $REPLY =~ ^[Yy][Ee][Ss]$ ]]; then
        print_info "Resetting database..."
        docker-compose down -v
        docker-compose up -d
        print_success "Database reset complete!"
    else
        print_info "Database reset cancelled."
    fi
}

# Function to access shell
shell() {
    service="${1:-web}"
    print_info "Accessing shell in $service container..."
    docker-compose exec "$service" bash
}

# Function to show help
show_help() {
    echo "BlogBreeze Docker Management Script"
    echo ""
    echo "Usage: ./docker.sh [command]"
    echo ""
    echo "Commands:"
    echo "  start       Start all containers"
    echo "  stop        Stop all containers"
    echo "  restart     Restart all containers"
    echo "  logs        View logs (add service name for specific logs)"
    echo "  status      Show container status"
    echo "  rebuild     Rebuild containers (after Dockerfile changes)"
    echo "  reset-db    Reset database (WARNING: deletes all data)"
    echo "  shell       Access container shell (default: web)"
    echo "  help        Show this help message"
    echo ""
    echo "Examples:"
    echo "  ./docker.sh start"
    echo "  ./docker.sh logs web"
    echo "  ./docker.sh shell db"
}

# Main script
check_docker

case "${1:-help}" in
    start)
        start
        ;;
    stop)
        stop
        ;;
    restart)
        restart
        ;;
    logs)
        logs "$2"
        ;;
    status)
        status
        ;;
    rebuild)
        rebuild
        ;;
    reset-db)
        reset_db
        ;;
    shell)
        shell "$2"
        ;;
    help|--help|-h)
        show_help
        ;;
    *)
        print_error "Unknown command: $1"
        echo ""
        show_help
        exit 1
        ;;
esac
