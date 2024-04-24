function showNotification(message, duration) {
    var notificationElement = document.createElement("div");
    notificationElement.classList.add("notification");
    notificationElement.textContent = message;
    document.body.appendChild(notificationElement);

    setTimeout(function() {
        notificationElement.remove();
    }, duration);
}


var userLogin = document.getElementById("UserLogin");
if (userLogin) {
    var user = userLogin.textContent;
    showNotification(user, 3000);
}

var userLogin1 = document.getElementById("UserLogin");
if (userLogin1) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_user.php', true); // Tạo yêu cầu GET đến tệp PHP để lấy thông tin user
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var user = xhr.responseText;
                showNotification(user, 3000);
            }
        }
    };
    xhr.send();
}