import {useState} from 'react';

const Exercice3 = () => {

    const [elements, setElements] = useState([])
    const [newElement, setNewElement] = useState('')

    const handleChange = (e) => {
        setNewElement(e.target.value)
    }

    const handleClick = () => {
        setElements([...elements, newElement])
        setNewElement('')
    }

    return (
        <>
            <h1>Exercice 3 :  Liste de courses</h1>
            <ul>
                {elements.map((element) => (
                     <li key={element}>
                        {element}
                    </li>
                ))}
            </ul>
            <input type="text" placeholder="Element a ajouter ...." onChange={handleChange} value={newElement}/>
            <button type="submit" onClick={handleClick}>Ajouter</button>
        </>
    );
}

export default Exercice3 ;