// Todo Codelab 2
let nama, email, alamat

document.getElementById("daftar").onclick = function () {
    nama = document.getElementById("nama").value
    email = document.getElementById("email").value
    alamat = document.getElementById("alamat").value
    

    if (nama == "") {
        alert("Nama tidak boleh kosong");
    } else if (email == "") {
        alert("Email tidak boleh kosong");
    } else if (alamat == "") {
        alert("Alamat tidak boleh kosong");
    } else {
        alert("Hello world, anda berhasil daftar");
    }
}