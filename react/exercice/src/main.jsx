import React from 'react'
import ReactDOM from 'react-dom/client'
import Exercice1 from './Exercice1.jsx'
import Exercice2 from "./Exercice2.jsx";
import Exercice3 from "./Exercice3.jsx";

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <Exercice1 />
      <Exercice2 />
      <Exercice3/>
  </React.StrictMode>,
)
