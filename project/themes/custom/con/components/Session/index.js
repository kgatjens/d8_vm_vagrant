import React from 'react';
import style from './style.css';

const Session = ({title,speaker, experience}) => {
    return (
        <div style={style.sessions}>
            <h3>{title}</h3>
            <p>{speaker}</p>
            <span>{experience}</span>
        </div>
    )
}

export default Session;