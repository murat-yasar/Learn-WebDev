import React, { useEffect, useState } from 'react'

import styles from './styles.module.css'

const initFormVals = {task: '', isDone: false};

function Form({ todos, setTodos }) {
  const [form, setForm] = useState(initFormVals);

  const onChangeInput = e => {
    setForm({...form, [e.target.name]: e.target.value});
  }

  const onSubmit = e => {
    e.preventDefault(); // to see the console.log output

    // Return false if input field is empty
    if (form.task === '') return false;   // if (!form.task) return false;
  
    // Add new task to the todo-list
    setTodos([...todos, form]);
  }
  
  // empty input field after submit
  useEffect(()=> {
    setForm(initFormVals);
  }, [todos]);

  return (
    <form 
      className={styles.form}
      onSubmit={onSubmit}
    >
      <input 
        type='text' 
        name='task' 
        value={form.task}
        placeholder='New task' 
        onChange={onChangeInput}
      />
      <button>Add</button>
    </form>
  )
}

export default Form