
[Source](https://medium.com/@noufel.gouirhate/create-your-own-mvc-framework-in-php-af7bd1f0ca19 "Permalink to Create your own MVC framework in PHP – Noufel Gouirhate – Medium")

# Tạo MVC framework trong PHP cho riêng bạn – Noufel Gouirhate – Medium
Trước khi học về MVC, Tôi đã phát triển các trang web theo cách tuyến tính. Tất nhiên, tôi đã tạo một file php cho mỗi trang. Và mỗi file thì đều pha trộn giữa php và html, một sự pha trộn thực sự khó chịu. Chúng tôi càng phát triển dự án thì chúng tôi càng gặp khó khăn trong việc duy trì nó : dư thừa rất nhiều trong cấu trúc HTML, Khó đọc code vì code php chèn trực tiếp vào view … Ngay cả khi dự án hoàn thành tốt, chúng tôi thực sự bắt đầu bị lẫn lộn với logic của chúng tôi

### Giải thích về MVC

Để tránh tình huống như trên, các developer bắt đầu nghĩ về một cách tổ chức code mới của một trang web. Một cách để làm điều đó chính là _MVC design pattern_. Mục tiêu là chia dự án thành ba phần lớn:

* **Model**: tương tác với cơ sở dữ liệu. Nó nhận, lưu trữ và lấy dữ liệu cho người dùng.
* **View**: hiển thị thông tin cho người dùng và tích hợp dữ liệu từ controller.
* **Controller**: gửi và nhận dữ liệu từ model và gửi đến view.

![][1]

### Cấu trúc

Để thiết lập design pattern này , Chúng ta sẽ cấu trúc lại project của chúng ta . Chúng ta có thể tìm thấy rất nhiều tài liệu về nó qua internet. Nhưng đây là những cái tôi đề nghị:

![][2]

Như bạn nhận thấy, chúng ta lấy ra phần chính của  MVC framework với 3 thư mục  (Models, Views, Controllers) và một số thứ khác nữa :

* Thư mục Webroot là thư mục duy nhất mà người dùng có thể truy cập.
* Router.php, dispatcher.php, request.php, .htaccess là một phần của hệ thống định tuyến.
* Config : tất cả các cấu hình cần thiết bởi trang web của chúng ta. Chúng ta sẽ truy xuất file db.php là điểm truy cập duy nhất vào cơ sở dữ liệu của chúng ta (singleton class).

### Mô hình Global

![][3]

Khi truy cập trang web của chúng ta, người dùng sẽ được tự động chuyển hướng đến Webroot/index.php nhờ  file .htaccess.

Đầu tiên sẽ chuyển hướng người dùng đến thư mục Webroot

![][4]

Và tiếp theo sẽ chuyển hướng anh/cô ấy đến index.php. Lưu ý rằng chúng ta có sử dụng tham số  (p=$1).

![][5]

index.php đang yêu cầu tất cả các tệp mà chúng tôi sẽ cần để khởi tạo bộ điều phối.Sau khi tạo một instance của Dispatch class, Chúng ta đã sẵn sàng để thiết lập logic định tuyến của chúng ta.

### Routing system (Hệ thống định tuyến)

#### _request.php_

Mục tiêu của tệp này là lấy url theo yêu cầu của người dùng.

![][7]

#### router.php

Bộ định tuyến lấy url được bắt bởi  _request.php_ và chia url thành 3 phần khác nhau dựa trên ký tự "/" :

![][8]

Những đầu vào này sẽ được xử lý bởi người điều phối (dispatcher). Người điều phối đang làm công việc tương tự như người điều khiển không lưu. Khi một yêu cầu mới được load, nó sẽ chọn controller và hành động với các tham số. Vì vậy, chỉ với một phương thức (dispatch()), chúng ta có thể khởi chạy tất cả logic định tuyến này.

![][9]

### Database (Cơ sở dữ liệu)
So we will have to call our database a lot of time
Model sẽ xử lý yêu cầu đến cơ sở dữ liệu của chúng ta. Vì vậy, chúng ta sẽ phải call cơ sở dữ liệu của chúng ta rất lâu. Nói một cách đơn giản, tại mỗi liên kết, chúng ta có thể tạo một instance của cơ sở dữ liệu. Giải pháp này không thực sự hiệu quả. Tôi khuyên chúng ta nên tạo một singleton để xử lý kết nối tới cơ sở dữ liệu của chúng ta:

![][10]

### MVC

 Bây giờ chúng ta đã thiết lập bộ điều phối, trang web của chúng ta có thể load một hành động từ controller.

Ở đây chúng ta muốn tạo một ứng dụng những việc cần làm, vì vậy chúng ta phải tạo một  _tasksController.php_. Controller này sẽ yêu cầu dữ liệu từ model Task.php và sau đó chuyển dữ liệu tới view. Để làm cho quá trình này dễ dàng hơn, chúng ta sẽ tạo một  parent class Controller để xử lý việc này.

![][11]

Phương thức _set ()_ sẽ hợp nhất tất cả dữ liệu mà chúng ta muốn truyền ra view.

Phương thức  _render()_ sẽ nhập dữ liệu với trích xuất phương thức và sau đó tải bố cục được yêu cầu trong thư mục Views. Hơn nữa, điều này cho phép chúng ta có một bố cục tránh sự lặp lại ngu ngốc của HTML trong quan điểm của chúng ta.

Chúng ta đã sẵn sàng để làm việc trên tasksController.php. Để test code của chúng ta, Tôi sẽ tạo một action index :

![][12]

Và xem nhanh với message "Hello".

Và đây là kết quả :

![][13]

MVC framework của chúng ta đã được thiết lập ! Bây giờ chúng ta chỉ cần thực hiện các hành động CRUD về tác vụ nguồn. Nếu bạn muốn biết thêm chi tiết về điều này và nhận trang web với các nhiệm vụ CRUD, bạn có thể kiểm tra repo trên Github của tôi.

Vì vậy, bây giờ, bạn đã phát triển một cấu trúc MVC bền vững hơn nhiều so với trang web php truyền thống của chúng tôi. But there is still a lot of work to do (security, error handling…). Nhưng vẫn còn rất nhiều việc phải làm (bảo mật, xử lý lỗi lỗi). Các chủ đề này đã được xử lý bởi các framework như Laravel hoặc Symfony.

[1]: https://cdn-images-1.medium.com/max/1600/1*xnuMvzXzmAxYXcRrd1Wj5Q.png
[2]: https://cdn-images-1.medium.com/max/1600/1*IA0nHOylfQYxjnGwi1XGaQ.png
[3]: https://cdn-images-1.medium.com/max/1600/1*gRErOZyn7ptn373U9fv0Yg.png
[4]: https://cdn-images-1.medium.com/max/1600/1*_agMehf9fNamnUtWqnv4kg.png
[5]: https://cdn-images-1.medium.com/max/1600/1*I67GugEBv0ONYruFet_wbA.png
[6]: https://cdn-images-1.medium.com/max/1600/1*tPlzi7umbyf6JJ9WSkfx8w.png
[7]: https://cdn-images-1.medium.com/max/1600/1*3m5NfXYUAoDAllbVdS8N1w.png
[8]: https://cdn-images-1.medium.com/max/1600/1*EVNESudstEyfXwvx6b5f1Q.png
[9]: https://cdn-images-1.medium.com/max/1600/1*I9mpgAX_OpaJa35jiQfUVg.png
[10]: https://cdn-images-1.medium.com/max/1600/1*EBlYRwirAwcywwTg0T1waw.png
[11]: https://cdn-images-1.medium.com/max/1600/1*Dmg_0gOYlq5ONFlKRkfbGw.png
[12]: https://cdn-images-1.medium.com/max/1600/1*n6l3kSUruZfOxpUNmKgTHA.png
[13]: https://cdn-images-1.medium.com/max/1600/1*MSUdTGHL_ozUGdBVeixirQ.png

  
