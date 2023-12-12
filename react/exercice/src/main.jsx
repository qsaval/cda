import React from 'react'
import ReactDOM from 'react-dom/client'
import Exercice1 from './Exercice1.jsx'
import Exercice2 from "./Exercice2.jsx";
import Exercice3 from "./Exercice3.jsx";
import ThemovieDB from "./ThemovieDB.jsx";
import './style.css'

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <div className="container">
      <div className="composant">
        <h1>La liste d'exercice</h1>
        <Exercice1 />
        <Exercice2 />
        <Exercice3/>
        <ThemovieDB/>
      </div>
    </div>
  </React.StrictMode>,
)
