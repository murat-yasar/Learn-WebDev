import React, { useState } from 'react'
import styles from './styles.module.css'

function List({ todos, setTodos }) {

  return (
    <ul className={styles.list}>
      {todos.map((todo, i) => (
        <li key={i} className={styles.row}>
          <form>
            <input 
              type='checkbox' 
              checked={todo.isDone}
            />
            <input 
              type='text' 
              name='task' 
              value={todo.task}
              placeholder={todo.task} 
              // onChange={onChangeInput}
            />
            <button>x</button>
          </form>
        </li>
      ))}
    </ul>
  )
}

export default List