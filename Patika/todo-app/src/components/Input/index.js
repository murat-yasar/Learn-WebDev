import styles from './styles.module.css'

import React, { useEffect, useState } from 'react'

// Set initial input values
const initInputVals = {todo: '', isDone: false};

function Input({ setTodos, todos }) {
  const [input, setInput] = useState(initInputVals);

  // Reset form fields after submit
  useEffect(() => {
    setInput(initInputVals);
  }, [todos]);

  const onChangeInput = (e) => {
    setInput({ ...input, [e.target.name]: e.target.value });
  }

  const onSubmit = (e) => {
    e.preventDefault();

    // Do not proceed, unless the field fulfilled
    if (input.todo === '') return false;

    // Add new task to the list
    setTodos([...todos, input]);
  }

  return (
    <div className="input">
      <form  onSubmit={onSubmit}>
        <input className='toggle-all' type='checkbox' />
        <label for="toggle-all">Mark all as complete</label>
        <input 
          type='text'
          className='new-todo'  
          name='todo' 
          value={input.todo}
          placeholder='New Todo' 
          onChange={onChangeInput}
          autoFocus
        />
        {/* <button>Add Task</button> */}
      </form>
    </div>
  )
}

export default Input