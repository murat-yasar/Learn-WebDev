import styles from './styles.module.css'

import React from 'react'

function Input() {
  return (
    <div className="header">
      <form>
        <input class="toggle-all" type="checkbox" />
        <label for="toggle-all">Mark all as complete</label>
        <input className="new-todo" placeholder="What needs to be done?" autoFocus />
      </form>
    </div>
  )
}

export default Input