function openImg(id_img) {
	var modal = document.getElementById("modal_image");
	id = "#" + id_img;
	console.log("ECCO L'ID ---> " + id);
	/*var img = document.getElementById("id_img").src;*/

	src_img = $(id).attr('src');
	console.log("ECCO L'IMMAGINE ---> " + src_img);
	var modalImg = document.getElementById("img01");

	modal.style.display = "block";
	modalImg.src = src_img;

	// Chiusura della modale 
	modal.onclick = function() { 
	    modal.style.display = "none";
	}
}