import './../styles.css'
import React, { useState } from "react";

function List({ contacts }) {
  const [filterContact, setFilterContact] = useState("");

  const filteredList = contacts.filter((item) => {
    return Object.keys(item).some((key) => 
      item[key]
        .toString()
        .toLowerCase()
        .includes(filterContact.toLocaleLowerCase())
    );
  });

  return (
    <div>
      <br />
      <h2>Contacts List</h2>
      <input 
        type="text" 
        placeholder="Filter contact" 
        value={filterContact} 
        onChange={e => setFilterContact(e.target.value)}
      />
      <ul className="contact-list">
        {filteredList.map((contact, i) => (
          <li key={i}>
            <span>{contact.fullName} </span>
            <span>{contact.phoneNumber}</span>
          </li>
        ))}
      </ul>
      <p className='item-number'><strong>{filteredList.length}</strong> contact(s) found</p>
    </div>
  );
}

export default List;
