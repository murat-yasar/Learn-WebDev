import styles from './styles.module.css'

import React from 'react'

function List({ todos }) {
	console.log(todos)
  return (
    <ul className='todo-list'>
			{todos.map((todo, i) => (
				<li 
					key={i}
					className={(todo.isDone === true) && 'completed'} 
				>
					<div className='view'>
						<input 
							type='checkbox' 
							className='toggle' 
							checked={todo.isDone}
						/>
						<span>{todo.task}</span>
						<button className='destroy'></button>
					</div>
				</li>
      ))}
		</ul>
  )
}

export default List