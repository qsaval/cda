import {useState} from 'react';

const Exercice1 = () => {

    const [nom, setNom] = useState("");
    const [prenom, setPrenom] = useState("");

    const handleChangeNom = (e) => {
       setNom(e.target.value);
    }

    const handleChangePrenom = (e) => {
        setPrenom(e.target.value);
    }

    return (
        <div className="container mt-5">
            <h1>Exercice 1 </h1>
           <input type="text" placeholder="Votre nom" onChange={handleChangeNom} value={nom}/>
            <input type="type" placeholder="Votre prenom" onChange={handleChangePrenom} value={prenom}/>
            <p>Bonjour {nom} {prenom}</p>
        </div>
    );
}

export default Exercice1 ;