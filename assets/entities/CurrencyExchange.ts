export interface CurrencyExchange {
    base_currency: string,
    target_currency: string,
    rate: number,
    updated_at: Date;
}