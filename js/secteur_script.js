function chargerListeDate() 
{
    //Ajouter les services sans direction dans le select
    xhr_object = new XMLHttpRequest(); 
    xhr_object.open("GET", "../listeDate.php?liaison="+liaison, true); 
    xhr_object.send(null); 
    xhr_object.onreadystatechange = function()
    {
        // instructions de traitement de la réponse
        if (xhr_object.readyState == 4) 
        {
            if(xhr_object.status  == 200) 
                service.innerHTML='<option  selected value="">Choisir un service</option>'+xhr_object.responseText;
        }
    };
}
