function decide() {
    var doc = opener.document; // Access the parent window that opened the window through the opener object that executed window.open
    doc.getElementById("decide").innerHTML = "<span style='color:blue;'>This ID is available.</span>";
    doc.getElementById("decide_id").value =
        doc.getElementById("userid").value;
    doc.getElementById("userid").disabled = true;
    doc.getElementById("join_button").disabled = false;
    doc.getElementById("check_button").value = "Change to another ID";
    doc.getElementById("check_button").setAttribute("onclick", "change()");
    window.close();
}

function change() {
    document.getElementById("decide").innerHTML =
        "<span style='color:red;'>* Please double check your ID</span>";
    document.getElementById("userid").disabled = false;
    document.getElementById("userid").value = "";
    document.getElementById("join_button").disabled = true;
    document.getElementById("check_button").value = "ID Double Check";
    document.getElementById("check_button").setAttribute("onclick", "checkId()");
}

function checkId() {
    var userid = document.getElementById("userid").value;
    if (userid) {
        url = "check.php?userid=" + userid;
        window.open(url, "chkid", "width=600, height=200");
    } else {
        alert("Please enter your ID.");
    }
}

const sendit = () => {
    const userid = document.regiform.userid;
    const userpw = document.regiform.userpw;
    const userpw_ch = document.regiform.userpw_ch;
    const username = document.regiform.username;
    const useremail = document.regiform.useremail;

    // Executes if the username value is empty.
    if (username.value == "") {
        alert("Please enter your nickname.");
        username.focus();
        return false;
    }
    // Korean name format regular expression
    const expNameText = /[가-힣a-zA-Z0-9]+$/;
    // Check if the username value matches a regular expression
    if (!expNameText.test(username.value)) {
        alert("The name format is incorrect. Please enter it in the correct format.");
        username.focus();
        return false;
    }
    if (username.value.length > 10) {
        alert("Please enter a name of 10 characters or less.");
        username.focus();
        return false;
    }

    if (userid) {
        if (userid.value == "") {
            alert("Please enter your ID.");
            userid.focus();
            return false;
        }
        // Executes if the userid value exceeds 4 to 12 characters.
        if (userid.value.length < 3 || userid.value.length > 10) {
            alert("Please enter your ID between 3 and 10 characters.");
            userid.focus();
            return false;
        }
    }

    // Runs if the userpw value is empty.
    if (userpw.value == "") {
        alert("Please enter your password.");
        userpw.focus();
        return false;
    }
    // Executes if userpw_ch value is empty.
    if (userpw_ch.value == "") {
        alert("Please enter your password check.");
        userpw_ch.focus();
        return false;
    }
    // Executes if the userpw value exceeds 6 to 20 characters.
    if (userpw.value.length < 3 || userpw.value.length > 20) {
        alert("Please enter your password between 3 and 20 characters.");
        userpw.focus();
        return false;
    }
    // Executes if the userpw value and userpw_ch value are different.
    if (userpw.value != userpw_ch.value) {
        alert("Passwords do not match. Please enter again.");
        userpw_ch.focus();
        return false;
    }

    // If the useremail value is empty, a notification window appears, focuses on the input, and returns False.
    if (useremail.value == "") {
        alert("Please enter your email.");
        useremail.focus();
        return false;
    }
    // Email Format Regular Expression
    const expEmailText = /[a-zA-Z0-9]+$/;
    // Check if useremail value matches regular expression
    if (!expEmailText.test(useremail.value)) {
        alert("The email format is incorrect.");
        useremail.focus();
        return false;
    }
    return true;
};