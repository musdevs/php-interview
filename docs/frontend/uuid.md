# UUID

[UUID в JavaScript](https://htmlacademy.ru/blog/js/uuid-generation)

Для production-приложений рекомендуем использовать такую функцию

```javascript
function generateSafeUUID() {
    try {
        // Предпочтительный способ
        if (typeof crypto !== 'undefined' && crypto.randomUUID) {
            return crypto.randomUUID();
        }

        // Fallback для старых сред
        if (typeof crypto !== 'undefined' && crypto.getRandomValues) {
            const pattern = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx';
            return pattern.replace(/[xy]/g, (c) => {
                const r = crypto.getRandomValues(new Uint8Array(1))[0] % 16;
                const v = c === 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        // Последний fallback - только для development!
        if (process.env.NODE_ENV === 'development') {
            console.warn('Using timestamp-based fallback UUID');
            return `fallback-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
        }

        throw new Error('No secure UUID generation method available');
    } catch (error) {
        console.error('UUID generation failed:', error);
        throw new Error('Failed to generate unique identifier');
    }
}
```
