import React, { useEffect, useState } from 'react'

import styles from './styles.module.css'

import Form from '../Form'
import List from '../List'
import Menu from '../Menu'

function Main() {
  const [todos, setTodos] = useState([
    {task: 'learn HTML', isDone: true},
    {task: 'learn CSS', isDone: true},
    {task: 'learn JavaScript', isDone: true},
    {task: 'learn React', isDone: false},
    {task: 'learn NodeJS', isDone: false},
  ]);

  useEffect(()=>{
    console.log(todos);
  }, )

  return (
    <div className={styles.main}>
      <Form todos={todos} setTodos={setTodos} />
      <List todos={todos} />
      {/* <Menu todos={todos} /> */}
    </div>
  )
}

export default Main