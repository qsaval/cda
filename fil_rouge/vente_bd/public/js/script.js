document.getElementById('registration').addEventListener('submit', function(e){
    e.preventDefault();

    var erreur;
    var erreur1 = false;
    var nom = document.getElementById('registration_form_nomUser');
    var prenom = document.getElementById('registration_form_prenomUser');
    var type = document.getElementById('registration_form_type');
    var email = document.getElementById('registration_form_email');
    var adresse = document.getElementById('registration_form_adresseFacturation');
    var ville = document.getElementById('registration_form_villeFacturation');
    var code = document.getElementById('registration_form_cpFacturation');
    var password = document.getElementById('registration_form_plainPassword_first');
    var password2 =  document.getElementById('registration_form_plainPassword_second');
    var emailTest = /^[a-z0-9.-]+@[a-z0-9.-]{2,}.[a-z]{2,4}$/;
    var coordonneTest = /^[A-Z,a-z]+$/;
    var codeTest = /^[0-9]+$/;
    var adresseTest = /^[a-zA-Z0-9\s\,\''\-]*$/;
    var passwordTest = /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;

    if(nom.validity.valueMissing){
        erreur=document.getElementById("erreurNom");
        erreur.innerHTML="entrez votre nom s.v.p";
        erreur1=true;
    }
    if(prenom.validity.valueMissing){
        erreur=document.getElementById("erreurPrenom");
        erreur.innerHTML="entrez votre prenom s.v.p";
        erreur1=true;
    }
    if(type.value == ''){
        erreur=document.getElementById("erreurType");
        erreur.innerHTML="profectionnel ou paticulier";
        erreur1=true;
    }
    if(email.value == ''){
        erreur=document.getElementById("erreurEmail");
        erreur.innerHTML="email incorret";
        erreur1=true;
    }
    if(adresse.value == ''){
        erreur=document.getElementById("erreurAdresse");
        erreur.innerHTML="entrez votre adresse s.v.p";
        erreur1=true;
    }
    if(ville.value == ''){
        erreur=document.getElementById("erreurVille");
        erreur.innerHTML="entrez votre ville s.v.p";
        erreur1=true;
    }
    if(code.value.length > 0 && code.value.length < 5){
        erreur=document.getElementById("erreurCode");
        erreur.innerHTML="code postal incorret";
        erreur1=true;
    }
    if(password.validity.valueMissing){
        erreur=document.getElementById("erreurPassword");
        erreur.innerHTML="mot de passe incorret";
        erreur1=true;
    }
    if(!coordonneTest.test(nom.value)){
        erreur=document.getElementById("erreurNom");
        erreur.innerHTML="entrez votre nom s.v.p";
        erreur1=true;
    }
    if(!coordonneTest.test(prenom.value)){
        erreur=document.getElementById("erreurPrenom");
        erreur.innerHTML="entrez votre prenom s.v.p";
        erreur1=true;
    }
    if(!coordonneTest.test(ville.value)){
        erreur=document.getElementById("erreurVille");
        erreur.innerHTML="entrez votre ville s.v.p";
        erreur1=true;
    }
    if(!codeTest.test(code.value)){
        erreur=document.getElementById("erreurCode");
        erreur.innerHTML="code postal incorret";
        erreur1=true;
    }
    if(!adresseTest.test(adresse.value)){
        erreur=document.getElementById("erreurAdresse");
        erreur.innerHTML="entrez votre adresse s.v.p";
        erreur1=true;
    }
    if(!emailTest.test(email.value)){
        erreur=document.getElementById("erreurEmail");
        erreur.innerHTML="email incorret";
        erreur1=true;
    }
    if(!passwordTest.test(password.value)){
        erreur=document.getElementById("erreurPassword");
        erreur.innerHTML="mot de passe incorret";
        erreur1=true;
    }
    if(password != password2){
        erreur=document.getElementById("erreurPassword");
        erreur.innerHTML="les deux mot de passe ne correspond pas";
        erreur1=true;
    }

    if(erreur1){
        e.preventDefault();
        return true;
    }
    else{
        return true;
    }
})