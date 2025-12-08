# Excel Template Instructions

## How to Use Excel Template for Event Budget Export

### Setup:
1. Create your Excel template file with your desired format, headers, logos, etc.
2. Save it as `event_budget_template.xlsx`
3. Place it in this folder: `storage/app/templates/`

### Template Structure:
- The system will automatically fill data starting from **row 44**
- **PEMASUKAN (Income)** section starts at row 44
- **PENGELUARAN (Expenses)** section will be placed after pemasukan data
- Your template should include any headers, logos, or formatting above row 44

### What Gets Auto-Filled:
- **Row 44**: "PEMASUKAN" header (merged C44:H44)
- **Row 45**: Column headers (No, Item, Harga, Jumlah, Total)
- **Row 46+**: Income data with auto-calculated totals
- Then: "PENGELUARAN" section with the same format
- Finally: Summary totals (TOTAL PEMASUKAN, TOTAL PENGELUARAN, GRAND TOTAL)

### Fallback:
If no template file is found, the system will create a new spreadsheet automatically with the standard format.

### Example Template Content (Above Row 44):
You can add:
- Company logo
- Event name placeholders
- Date fields
- Any static headers or branding
- Custom styling

The data will be inserted starting from row 44 onwards, preserving everything above it.
