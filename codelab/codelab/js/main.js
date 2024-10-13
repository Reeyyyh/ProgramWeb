
let pertama, kedua, jumlah, reset

// Todo Codelab 1
document.getElementById("jumlahkan").onclick = function () {
    pertama = Number(document.getElementById("pertama").value);
    kedua = Number(document.getElementById("kedua").value);

    jumlah = pertama + kedua;

    document.getElementById("hasil").textContent = `Hasil: Hello world`; //${jumlah}
};

document.getElementById("reset").onclick = function () {
    document.getElementById("hasil").textContent = `Hasil: 0`;
}