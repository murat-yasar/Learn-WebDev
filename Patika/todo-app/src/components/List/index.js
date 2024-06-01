import React, { useState, useEffect } from 'react'
import styles from './styles.module.css'

function List({ todos }) {
  const [filtered, setFiltered] = useState([...todos]);
  const [activeBtn, setActiveBtn] = useState('all');

  // Add new tasks to filtered list
  useEffect(()=> {
    setFiltered(todos);
  }, [todos]);

  const filterAll = () => {
    setFiltered(todos.map(todo => todo))
    setActiveBtn('all')
  }

  const filterActive = () => {
    setFiltered(todos.filter(todo => todo.isDone === false))
    setActiveBtn('active')
  }

  const filterCompleted = () => {
    setFiltered(todos.filter(todo => todo.isDone === true))
    setActiveBtn('completed')
  }

  return (
    <>
      <ul className={styles.list}>
        {filtered.map((todo, i) => (
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

      <form className={styles.menu} >
        <span className={styles.todoCount}>
          <strong> {filtered.length} </strong> items left
        </span>

        <ul className={styles.filters}>
          <li>
            <button 
              className={activeBtn === 'all' ? 'selected' : ''}
              onClick={filterAll}
            >
              All
            </button>
          </li>
          <li>
            <button 
              className={activeBtn === 'active' ? 'selected' : ''}
              onClick={filterActive}
            >
              Active
            </button>
          </li>
          <li>
            <button 
              className={activeBtn === 'completed' ? 'selected' : ''}
              onClick={filterCompleted}
            >
              Completed
            </button>
          </li>
        </ul>

        <button 
          className={styles.clearCompleted} 
        >
          Clear completed
        </button>
      </form>
    </>
  )
}

export default List