import React, { useState } from 'react'

import styles from './styles.module.css'

function List({ todos }) {
  return (
    <table>
      {todos.map((todo, i) => (
        <tr key={i} className={styles.row}>
          <td><input type='checkbox' /></td>
          <td>{todo.task}</td>
          <td><button>x</button></td>
        </tr>
      ))}
    </table>
  )
}

export default List