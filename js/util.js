

export const getProduct = async (route) => {
    try {
        const validRoutes = ['makanan', 'sidedish', 'minuman'];
        if (!validRoutes.includes(route)) {
            throw new Error('Invalid route');
        }

        const response = await fetch(`../admin_dashboard/model/model.php?route=${route}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

export default getProduct;