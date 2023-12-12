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
        <div className="container composant">
            <h1>Exercice 3 :  Liste de courses</h1>
            <input type="text" placeholder="Element a ajouter ...." onChange={handleChange} value={newElement}/>
            <button type="submit" onClick={handleClick}>Ajouter</button>
            <hr/>
            {elements.map((element) => (
                <div key={element}>
                    {element}
                </div>
            ))}
        </div>
    );
}

export default Exercice3 ;