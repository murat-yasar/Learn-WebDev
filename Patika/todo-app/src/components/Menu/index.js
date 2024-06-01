import React from 'react'
import styles from './styles.module.css'


function Menu() {
  return (
    <section className={styles.menu} >
      <span className={styles.todoCount}>
        <strong> {3} </strong> items left
      </span>

      <ul className={styles.filters}>
        <li>
          <a href="#/" className={styles.selected}>All</a>
        </li>
        <li>
          <a href="#/">Active</a>
        </li>
        <li>
          <a href="#/">Completed</a>
        </li>
      </ul>

      <button className={styles.clearCompleted}>
        Clear completed
      </button>
    </section>
  )
}

export default Menu