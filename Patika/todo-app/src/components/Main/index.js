import styles from './styles.module.css'

import React from 'react'
import Input from '../Input'
import List from '../List'
import Menu from '../Menu'

import { useEffect, useState } from 'react'

function Main() {
  const [todos, setTodos] = useState([
    {task: 'learn HTML', isdone: true},
    {task: 'learn CSS', isdone: true},
    {task: 'learn JavaScript', isdone: true},
    {task: 'learn React', isdone: false},
    {task: 'learn nodeJS', isdone: false},
  ]);

  // Get the change if todos changes
  useEffect(()=>{
    console.log(todos);
  }, [todos]);

  return (
    <div className='main'>
      {/* <Input addTodo={setTodos} todos={todos} /> */}
      <List addTodo={setTodos} todos={todos} />
      {/* <Menu /> */}
    </div> 
  )
}

export default Main