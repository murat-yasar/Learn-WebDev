import './styles.css';

import React, { useEffect, useState } from 'react'
import List from './List'
import Form from './Form';

function Contacts() {
  const [contacts, setContacts] = useState([
    {fullName: 'Ahmet', phoneNumber: '123123'},
    {fullName: 'Mehmet', phoneNumber: '234567'},
    {fullName: 'Mustafa', phoneNumber: '345678'},
    {fullName: 'Murat', phoneNumber: '567890'}
  ]);

  // Get the change if contacts changes
  useEffect(()=>{
    console.log(contacts);
  }, [contacts]);
  
  return (
    <div id='container'>
      <h1 className='app-header'>Contacts App</h1>
      <Form addContact={setContacts} contacts={contacts} />
      <List contacts={contacts} />
    </div>
  )
}

export default Contacts;