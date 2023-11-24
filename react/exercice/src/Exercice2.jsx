import {useState} from 'react';

const Exercice2 = () => {

    const [count, setCount] = useState(0);

    const handleClick = () => {
        setCount(c => c + 1)
    };

    return (
        <div className="container my-5 composent">
            <h1>Exercice2 : Compteur</h1>
            <button onClick={handleClick}>Compteur = {count}</button>
        </div>
    );
}

export default Exercice2 ;