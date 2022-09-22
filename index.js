document.addEventListener('DOMContentLoaded', ()=>{       
    const root = document.querySelector('#root');
    const template = document.querySelector('#item_template').content.cloneNode(true);
    root.appendChild(template);

    document.getElementById('submit').addEventListener('click', ()=>{

        submit();
    })
    document.getElementById('add_item').addEventListener('click', ()=>{
        add_item();
    })
    document.getElementById('save').addEventListener('click', ()=>{
        save_table();
    })
    document.getElementById('checkall').addEventListener('change', ()=>{
        check_all();
    })
    load_table();
})

const submit = async ()=>{
    const items = Array.from(document.getElementById('table').querySelectorAll('tr'));
    const data = [];
    const managerName = document.getElementById('managerName').value;
    const days_count = document.getElementById('days_count').value;
    items.forEach((item,i )=>{
        if (i > 0 && item.cells[0].querySelector('input').checked){
            const cells = item.cells;
            const id = cells[1].innerHTML;
            const title = cells[2].innerHTML;
            const description = cells[3].innerHTML;
            const images = cells[4].innerHTML;
            const price = cells[5].innerHTML;
            const time = cells[6].innerHTML;
            const place = cells[7].innerHTML;
            const subtype = cells[8].innerHTML;
            const contactMethod = cells[9].innerHTML;
            const phone = cells[10].innerHTML;
            const adStatus = cells[11].innerHTML;
            const gbt = cells[12].innerHTML;
            const obj = {id, title, description, images, price, time, place, 
                         subtype, contactMethod, phone, adStatus, gbt, managerName, days_count};
            data.push(obj);
            console.log(obj);
        }

    })
    const body = JSON.stringify(data)
    console.log(body);

    //fetch
    const params = {
        method: 'POST',
        headers: {
            'content-type': 'application/json'
        },
        body: (body)
    }

    const response = await fetch('utils/generate.php',params)
    
    response.text()
        .then((data) => {
            document.getElementById('dump').innerHTML = data
        })
}

const add_item = async () => {
    const titles = document.querySelector('input[name="title"]').value.split(', ');
    const description = document.querySelector('select[name="descriptions"]').value;
    const images = document.querySelector('select[name="image_folder"]').value;
    const price = document.querySelector('input[name="price"]').value;
    const time = document.querySelector('select[name="time"]').value;
    const place = document.querySelector('select[name="place"]').value;
    const subtype = document.querySelector('select[name="goods_subtype"]').value;
    const contact_mode = document.querySelector('select[name="contact_mode"]').value;
    const phone = document.querySelector('input[name="phone"]').value;
    const table = document.getElementById('table');
    const adStatus = document.querySelector('select[name="adStatus"]').value;
    const gbt = document.querySelector('select[name="gbt"]').value;
    
    titles.forEach(async (title)=>{
        const template = document.createElement('tr');
        const responce = await fetch('utils/gen_uuid.php',{method: 'GET'});
        responce.text()
        .then((data) => {
        
            let td = document.createElement('td');
            const chkbx = document.createElement("input");
            chkbx.type = "checkbox";
            chkbx.classList.add("row_chk");
            chkbx.checked = document.getElementById('checkbox').checked;
            td.appendChild(chkbx);
            template.appendChild(td);

            const id=data;
            template.id = id;
             td = document.createElement('td');
            td.innerHTML = id;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = title;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = description;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = images;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = price;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = time;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = place;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = subtype;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = contact_mode;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = phone;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = adStatus;
            template.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = gbt;
            template.appendChild(td);
            td = document.createElement('td');
            let btn = document.createElement('button');
            btn.innerHTML = "e";
            btn.addEventListener('click',()=>{
                edit_row(id)
            })
            td.appendChild(btn);
            template.appendChild(td);
            td = document.createElement('td');
            btn = document.createElement('button');
            btn.innerHTML = "d";
            btn.addEventListener('click',()=>{
                delete_row(id)
            })
            td.appendChild(btn);
            template.appendChild(td);
            table.appendChild(template);    
            
        })
   
    })
    save_table();
}


const save_table = async ()=>{
    const table = document.getElementById('table');
    const rows = Array.from(table.getElementsByTagName('tr'));
    const tablevals = [];
    rows.forEach((row, i) =>{
        if (i > 0){
            let values = Array.from(row.getElementsByTagName('td'))
                    .map((item,i) => (i==0)? item.querySelector('input').checked : item.innerHTML)
                    .slice(0, -2);
            
            tablevals.push(values);          
        }
    })
    
    const body = JSON.stringify(tablevals);
    console.log(body);

    //fetch
    const params = {
        method: 'POST',
        headers: {
            'content-type': 'application/json'
        },
        body: (body)
    }

    const response = await fetch('utils/save_table.php',params)
    response.text()
    .then(data =>{
        document.getElementById('dump').innerHTML = data
    })
    .catch(error => {
        document.getElementById('dump').innerHTML = "ERROR"
    })
}

const load_table = async()=>{
    const jsondata = await fetch('utils/load_table.php',{method:"GET"})
    jsondata.json().then(result=> {
        data = result;

        const table = document.getElementById('table');
        result.forEach(row =>{
            const tr = document.createElement('tr');
            tr.id = row[1];
            const tr0 = document.createElement('td');
            const chkbx = document.createElement("input");
            chkbx.type = "checkbox";
            chkbx.classList.add("row_chk");
            chkbx.checked = row[0];
            tr0.appendChild(chkbx);
            tr.appendChild(tr0);
            row.slice(1).forEach(item =>{
                
                const cell = document.createElement('td');
                cell.innerHTML = item;
                tr.appendChild(cell);
            })
            let td = document.createElement('td');
            let btn = document.createElement('button');
            btn.innerHTML = "e";
            btn.addEventListener('click',()=>{
                edit_row(row[0])
            })
            td.appendChild(btn);
            tr.appendChild(td);
            td = document.createElement('td');
            btn = document.createElement('button');
            btn.innerHTML = "d";
            btn.addEventListener('click',()=>{
                delete_row(row[0])
            })
            td.appendChild(btn);
            tr.appendChild(td);
            table.appendChild(tr)
        })
    })

}

const delete_row = (id)=>{
     const row = document.getElementById(id);
     row.parentElement.removeChild(row);
}

const edit_row = (id)=>{
    const row = Array.from(document.getElementById(id).getElementsByTagName('td'));
    let title = row[1].innerHTML;
    let price = row[4].innerHTML;
    title = prompt("Заголовок", title);
    price = prompt("Цена", price);
    row[1].innerHTML = title;
    row[4].innerHTML = price;
    save_table();
}

const check_all = () =>{
    const state = document.getElementById('checkall').checked;
    Array.from(document.getElementsByClassName("row_chk")).forEach(item=> {item.checked = state})
}