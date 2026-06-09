
// let currentTab = 'school';
// let captchaValue = '';

// function switchTab(tab) {
//     currentTab = tab;

//     document.getElementById('schoolField').classList.toggle('hidden', tab !== 'school');
//     document.getElementById('departmentField').classList.toggle('hidden', tab !== 'department');

//     document.getElementById('schoolTab').classList.toggle('bg-white', tab === 'school');
//     document.getElementById('departmentTab').classList.toggle('bg-white', tab === 'department');

//     document.getElementById('loginType').value = tab;
// }

// function togglePassword() {
//     let input = document.getElementById('password');
//     input.type = input.type === "password" ? "text" : "password";
// }

// function generateCaptcha() {
//     const chars = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
//     let result = "";

//     for (let i = 0; i < 5; i++) {
//         result += chars.charAt(Math.floor(Math.random() * chars.length));
//     }

//     document.getElementById('captchaBox').innerText = result;
// }

// window.onload = function () {
//     generateCaptcha();
// };

// async function login() {


//     let password = document.getElementById("password").value;

//     let res = await fetch("/public-key");
//     let data = await res.json();
//     console.log(data);

//     let encrypt = new JSEncrypt();
//     encrypt.setPublicKey(data.public_key);

//     let encrypted = encrypt.encrypt(password);

//     // 4. Send to backend
//     fetch("/login", {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json",
//             "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
//         },
//         body: JSON.stringify({
//             password: encrypted
//         })
//     });
// }
