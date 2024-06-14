

export const getProduct = async (route, productRoute) => {
    try {
        const validRoutes = ['makanan', 'sidedish', 'minuman'];;
        if (!validRoutes.includes(productRoute)) {
            throw new Error('Invalid route');
        }

        const response = await fetch(`../admin_dashboard/model/model.php?route=${route}&product=${productRoute}`);
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