let select = document.querySelectorAll('.select');
let Name = document.querySelector('#inputName');
let image = document.querySelector('#img');
let description = document.querySelector('#inputDescription');
let manufactures = document.querySelector('#inputmanufactures');
let price = document.querySelector('#inputPrice');
let protypes = document.querySelector('#inputprotypes');
let feature = document.querySelector('#inputfeature');
let click = document.querySelector('.click');

image.onclick = () =>
{
    image.setAttribute("type","file");
}