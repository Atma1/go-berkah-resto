

export const getAllProduct = async (productRoute) => {
    try {
        const validRoutes = ['makanan', 'sidedish', 'minuman'];;
        if (!validRoutes.includes(productRoute)) {
            throw new Error('Invalid route');
        }

        const response = await fetch(`../admin/model/model.php?route=get&product=${productRoute}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

export const getProduct = async (productRoute, productId) => {
    try {
        const validRoutes = ['makanan', 'sidedish', 'minuman'];;
        if (!validRoutes.includes(productRoute)) {
            throw new Error('Invalid route');
        }

        const response = await
        fetch(`../admin/model/model.php?route=get&product=${productRoute}&productId=${productId}`);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

export const deleteProduct = async (productRoute, productId) => {
    try {
        const response = await
        fetch(`../admin/model/model.php?route=delete&product=${productRoute}&productId=${productId}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const {status} = await response.json();
        if (status == "success") {
            return true;
        }
    } catch (error) {
        console.error('Error deleting data:', error);
    }
}

export default {getAllProduct, deleteProduct, getAllProduct};