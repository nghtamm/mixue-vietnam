# 🍦 Website bán đồ uống giải khát Mixue Việt Nam
Bài tập lớn: Lập trình Web với PHP và MySQL (Học kì 2 - Năm 3 - Học viện Ngân hàng)

## Mục lục
* [Thông tin cơ bản](#thông-tin-cơ-bản)
* [Techstack](#techstack)
* [Yêu cầu](#yêu-cầu)
* [Hướng dẫn sử dụng](#hướng-dẫn-sử-dụng)

## Thông tin cơ bản
Bố cục của website bán đồ uống giải khát Mixue Việt Nam bao gồm
- Trang chủ của website, nơi hiển thị danh sách cửa hàng khả dụng
- Trang đặt hàng bao gồm danh sách sản phẩm cùng giá thành và thông tin chi tiết của một cửa hàng cụ thể, cùng với giỏ hàng của người dùng
- Trang thanh toán bao gồm một thẻ thông tin đơn hàng để người dùng xác nhận và lựa chọn thời gian giao hàng; và một thẻ thông tin chi phí đơn hàng gồm có tổng tiền (tổng tiền hàng - giảm giá thành viên - voucher khuyến mại + phí vận chuyển) và lựa chọn phương thức thanh toán (Cash on Delivery - COD hoặc thanh toán trực tuyến thông qua cổng thông tin thanh toán [VNPAY](https://vnpay.vn/))
- Trang lịch sử đơn hàng, nơi người dùng có thể tra cứu tình trạng đơn hàng hiện tại đồng thời được cấp quyền tìm kiếm, truy cập lịch sử đơn hàng của bản thân
- Trang quản trị (administrator) CRUD, quản lý các thông tin liên quan tới cửa hàng, nhân viên, sản phẩm, hóa đơn, tài khoản hay báo cáo thu chi của cửa hàng theo từng khoảng thời gian

Chức năng của website bán đồ uống giải khát Mixue Việt Nam bao gồm
- Đăng ký, đăng nhập, đăng xuất: bao gồm hash mật khẩu người dùng (sử dụng thuật toán *Bcrypt* và *Argon2*), khi đăng ký có xác thực captcha sử dụng [Cloudflare Turnstile](https://www.cloudflare.com/vi-vn/products/turnstile/)
- Gửi email tới người dùng liên quan tới các vấn đề như mã OTP xác thực tài khoản, mã OTP reset mật khẩu, xác nhận tình trạng đơn hàng
- Lựa chọn cửa hàng mong muốn, sau đó lựa chọn các sản phẩm muốn mua và tùy ý tăng giảm số lượng, thay đổi các option đường - đá hoặc xóa sản phẩm khỏi giỏ hàng
- Tích hợp thanh toán trực tuyến thông qua cổng thông tin thanh toán [VNPAY](https://vnpay.vn/)
- Tự động tính toán phí vận chuyển dựa theo khoảng cách từ cửa hàng tới địa chỉ nhận hàng sử dụng API của [Google Maps Platform](https://mapsplatform.google.com/)
- Tạo liên kết webhook với [API của Telegram](https://core.telegram.org/bots/api), gửi thông tin đơn hàng vào group Telegram cụ thể (được xác định bởi telegram-group-id), từ đó nhân viên trong cửa hàng có thể nhận đơn hoặc hủy đơn tùy theo tình trạng hiện tại của cửa hàng, tự động cập nhật trạng thái đơn hàng vào database khi có nhân viên nhận/ hủy đơn hàng
- CRUD đối với các thông tin liên quan tới cửa hàng, nhân viên, sản phẩm, hóa đơn, tài khoản, có tính năng thống kê và xuất báo cáo thu chi của cửa hàng theo từng khoảng thời gian

### Disclaimer: Dự án này không phải là original content của nhóm mà chỉ là phiên bản chỉnh sửa của source đã có sẵn. Cảm ơn tới tác giả của project là [Nguyễn Hoài Nam](https://github.com/unclecatvn)

**Nhóm tác giả**
- [Nguyễn Hoàng Tâm](https://github.com/nghtamm)
- [Nguyễn Huy Phước](https://github.com/DurkYerunz)
- [Lương Ngọc Tuấn](https://github.com/TuanChill)
	
## Techstack
- HTML + CSS
- Ngôn ngữ lập trình PHP + Javascript
- Laravel
- NodeJS và Vite ([laravel/vite-plugin](https://github.com/laravel/vite-plugin))
- Bootstrap
- Docker
- MySQL sử dụng Navicat Premium
- Amazon Web Services (AWS)
	
## Yêu cầu
- Cài đặt [NodeJS](https://nodejs.org/en/download)
- Cài đặt [PHP](https://www.php.net/downloads.php) và [Composer](https://getcomposer.org/download/)

## Hướng dẫn sử dụng
*(Chỉ dành cho nhà phát triển)* Cài đặt plugin Vite
```
npm install
```
Cài đặt các package (service) của các vendor (provider)
```
composer install

// Khuyến cáo sử dụng WSL hoặc distro Linux để tránh xảy ra lỗi, nếu vẫn muốn tiếp tục cài đặt trên Windows
composer install --ignore-platform-reqs
```
Khởi chạy dự án
```
// Chạy migrations
php artisan migrate

// Bật server (trên local) và khởi chạy dự án Laravel
php artisan serve

// (Chỉ dành cho nhà phát triển) Bật Laravel Horizon để theo dõi queue
php artisan horizon

// Khởi tạo queue và đưa vào hoạt động
php artisan queue:work
```
