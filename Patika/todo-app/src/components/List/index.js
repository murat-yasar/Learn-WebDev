import React, { useState } from 'react'
import styles from './styles.module.css'

function List({ todos, setTodos }) {

  return (
    <ul className={styles.list}>
      {todos.map((todo, i) => (
        <li key={i} className={todo.isDone ? 'completed' : ''} >
          <form className={styles.view}>
            <input 
              type='checkbox' 
              className={styles.toggle}
              checked={todo.isDone}
            />
            <label>{todo.task}</label>
            <button className={styles.destroy}></button>
          </form>
        </li>
      ))}
    </ul>
  )
}

export default List