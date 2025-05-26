from itertools import product

def parse_expr(expr_str):
    # Replace logical symbols with Python syntax
    expr_str = expr_str.replace('~', 'not ')
    expr_str = expr_str.replace('^', 'and')
    expr_str = expr_str.replace('V', 'or')
    expr_str = expr_str.replace('v', 'or')
    expr_str = expr_str.replace('->', '<=')     # p -> q becomes (not p) or q, simulated with <=
    expr_str = expr_str.replace('<->', '==')    # p <-> q becomes p == q
    return expr_str

def make_lambda(expr_str, variables):
    expr_str = parse_expr(expr_str)
    code = compile(expr_str, "<string>", "eval")
    return lambda vars: eval(code, {}, vars)

def logical_equivalence(expr1, expr2, variables):
    for values in product([False, True], repeat=len(variables)):
        assignment = dict(zip(variables, values))
        if expr1(assignment) != expr2(assignment):
            return False
    return True

def user_input_mode():
    print("Enter logical expressions using: p, q, r, s")
    print("Operators:")
    print("  ~ for NOT, ^ for AND, V or v for OR, -> for IMPLIES, <-> for EQUIVALENT")
    print("Example: ~(p ^ q) V r")
    
    expr1_str = input("\nEnter first expression: ")
    expr2_str = input("Enter second expression: ")

    all_vars = ['p', 'q', 'r', 's']
    used_vars = [v for v in all_vars if v in expr1_str or v in expr2_str]

    expr1 = make_lambda(expr1_str, used_vars)
    expr2 = make_lambda(expr2_str, used_vars)

    result = logical_equivalence(expr1, expr2, used_vars)
    print("\nResult: Equivalent!" if result else "\nResult: Not equivalent.")

# Run the program
user_input_mode()
