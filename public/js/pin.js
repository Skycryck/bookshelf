var books = document.getElementsByClassName("book");

for (book of books) {
    book.onclick = function() {
        console.log("Evènement de click détecté");
        var id = this.id;
        var pin = document.getElementById('pin');
        pin.style.display = "block";
    };
};

var close = document.getElementById('pin').querySelector('a').onclick = function() {
    var pin = document.getElementById('pin');
    pin.style.display = "none";
}