!function() {
    var e = new XMLHttpRequest;
    e.open("GET", "./api/v1/drinks/get_all_drinks.php", !0),
    e.onreadystatechange = function() {
        if (4 === e.readyState && 200 === e.status) {
            for (var t = JSON.parse(e.responseText), a = document.querySelector("section.popular").querySelector(".box-container"); a.firstChild; )
                a.firstChild.remove();
            t.slice(0, 10).forEach(function(e) {
                var t = document.createElement("div");
                t.className = "box";
                var n = document.createElement("a");
                n.href = "#",
                n.className = "ri-heart-line wishlist-icon";
                var r = document.createElement("div");
                r.className = "image";
                var d = document.createElement("img");
                d.src = e.Image,
                d.alt = "",
                r.appendChild(d);
                var c = document.createElement("div");
                c.className = "content";
                var l = document.createElement("h3");
                l.textContent = e.DrinkName;
                var i = document.createElement("div");
                i.className = "stars";
                for (var s = 0; s < 5; s++) {
                    var m = document.createElement("i");
                    m.className = "fas fa-star",
                    i.appendChild(m)
                }
                var o = document.createElement("span");
                o.textContent = " (50) ";
                var p = document.createElement("div");
                p.className = "price",
                p.textContent = e.Price + " đ";
                var h = document.createElement("span");
                h.textContent = " $50.00",
                p.appendChild(h);
                var v = document.createElement("a");
                v.href = "detail_product.php", // Thay đổi đường dẫn tới trang "detail_product.php"
                v.className = "btn",
                v.textContent = "Read & Add to cart",
                c.appendChild(l),
                c.appendChild(i),
                c.appendChild(o),
                c.appendChild(p),
                c.appendChild(v),
                t.appendChild(n),
                t.appendChild(r),
                t.appendChild(c),
                a.appendChild(t)
            })
        }
    }
    ,
    e.send()
}();