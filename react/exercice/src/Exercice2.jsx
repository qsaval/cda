import {useState} from 'react';

const Exercice2 = () => {

    const [count, setCount] = useState(0)

    const handleClick = () => {
        setCount(c => c + 1)
    }

    return (
        <>
            <h1>exercice2 : Compteur</h1>
            <button onClick={handleClick}>Compteur = {count}</button>
        </>
    );
}

export default Exercice2 ;