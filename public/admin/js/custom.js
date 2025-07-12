

const getdatakelas = async (kode) => {
    const url = `/ajax-load-kelas?kode=${kode}`; // Tambahkan parameter langsung ke URL

    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        if (!response.ok) {
            throw new Error(`Request failed with status ${response.status}`);
        }

        const result = await response.json();
        console.log(result);
    } catch (error) {
        console.error('Error:', error.message);
    }
}

function handleError(error) {
    console.error('Error:', error.message || error);
}

async function getKelas() {
    const url = `{{ route('pembelian.store') }}`; // Your API endpoint

    const data = await fetchData(url); // Fetch the data from the API

    if (data) {
        console.log('User Data:', data); // Process or display the data
    }
}