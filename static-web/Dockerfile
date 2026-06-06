# Menggunakan image Nginx versi ringan
FROM nginx:alpine

# Menyalin file index.html milikmu ke dalam direktori default Nginx
COPY index.html /usr/share/nginx/html/index.html

# Membuka port 80 di dalam container
EXPOSE 80

# Menjalankan Nginx
CMD ["nginx", "-g", "daemon off;"]