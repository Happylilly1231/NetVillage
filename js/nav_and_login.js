function login() {
    location.href = '../user/login.php';
}
function regist() {
    location.href = '../user/regist.php';
}
function logout() {
    alert("You have been logged out.");
    location.href = "../user/logout.php";
}
function moveToSquare() {
    location.href = '../square/square.php';
}
function moveToVillage(village_id) {
    location.href = '../main/index.php?village=' + village_id;
}
function moveToHome() {
    location.href = '../home/home.php';
}
function moveToGarden() {
    location.href = '../garden/garden.php';
}
function moveToLibrary() {
    location.href = '../library/library.php';
}
function moveToToDoList() {
    location.href = '../home/to_do_list.php';
}
function moveToDiary() {
    location.href = '../home/diary.php';
}