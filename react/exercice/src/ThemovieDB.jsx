import React, {useEffect, useState} from 'react';
import './style.css'
const ThemovieDb = () => {
    const [data, setData] = useState([]);
    const [text, setText] = useState("");
    const [query, setQuery] = useState("")

    useEffect(() => {
        fetch('https://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query=' + query)
            .then(r => r.json())
            .then(data => {
                setData(data.results)
            })
    }, [query])

    const handleChange = (e) => {
      setText(e.target.value)
    }

    const handleClick = () => {
      setQuery(text);
      setText('')
    }

    return (
        <div className="container">
            <hr/>
            <div className="d-flex justify-content-center">
                <input value={text} onChange={handleChange} />
                <button onClick={handleClick}>rechercher</button>
            </div>
            <hr/>
            <div className="row">
                {data.map((item, index) => (
                    <div key={index} className="card col-3 m-3 carte">
                        <img src={"http://image.tmdb.org/t/p/w185" + item.backdrop_path}/>
                        <div className="card-body">
                            <h5 className="card-title">{item.title}</h5>
                        </div>
                    </div>
                ))}
            </div>

        </div>
    );
};

export default ThemovieDb;